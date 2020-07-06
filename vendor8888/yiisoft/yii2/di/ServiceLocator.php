<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\di;

use Closure;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * ServiceLocator implements a [service locator](http://en.wikipedia.org/wiki/Service_locator_pattern).
 *
 * To use ServiceLocator, you first need to register components IDs with the corresponding components
 * definitions with the locator by calling [[set()]] or [[setComponents()]].
 * You can then call [[get()]] to retrieve a components with the specified ID. The locator will automatically
 * instantiate and configure the components according to the definition.
 *
 * For example,
 *
 * ```php
 * $locator = new \yii\di\ServiceLocator;
 * $locator->setComponents([
 *     'db' => [
 *         'class' => 'yii\db\Connection',
 *         'dsn' => 'sqlite:path/to/file.db',
 *     ],
 *     'cache' => [
 *         'class' => 'yii\caching\DbCache',
 *         'db' => 'db',
 *     ],
 * ]);
 *
 * $db = $locator->get('db');  // or $locator->db
 * $cache = $locator->get('cache');  // or $locator->cache
 * ```
 *
 * Because [[\yii\base\Module]] extends from ServiceLocator, modules and the application are all service locators.
 * Modules add [tree traversal](guide:concept-service-locator#tree-traversal) for service resolution.
 *
 * For more details and usage information on ServiceLocator, see the [guide article on service locators](guide:concept-service-locator).
 *
 * @property array $components The list of the components definitions or the loaded components instances (ID =>
 * definition or instance).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ServiceLocator extends Component
{
    /**
     * @var array shared components instances indexed by their IDs
     */
    private $_components = [];
    /**
     * @var array components definitions indexed by their IDs
     */
    private $_definitions = [];


    /**
     * Getter magic method.
     * This method is overridden to support accessing components like reading properties.
     * @param string $name components or property name
     * @return mixed the named property value
     */
    public function __get($name)
    {
        if ($this->has($name)) {
            return $this->get($name);
        }

        return parent::__get($name);
    }

    /**
     * Checks if a property value is null.
     * This method overrides the parent implementation by checking if the named components is loaded.
     * @param string $name the property name or the event name
     * @return bool whether the property value is null
     */
    public function __isset($name)
    {
        if ($this->has($name)) {
            return true;
        }

        return parent::__isset($name);
    }

    /**
     * Returns a value indicating whether the locator has the specified components definition or has instantiated the components.
     * This method may return different results depending on the value of `$checkInstance`.
     *
     * - If `$checkInstance` is false (default), the method will return a value indicating whether the locator has the specified
     *   components definition.
     * - If `$checkInstance` is true, the method will return a value indicating whether the locator has
     *   instantiated the specified components.
     *
     * @param string $id components ID (e.g. `db`).
     * @param bool $checkInstance whether the method should check if the components is shared and instantiated.
     * @return bool whether the locator has the specified components definition or has instantiated the components.
     * @see set()
     */
    public function has($id, $checkInstance = false)
    {
        return $checkInstance ? isset($this->_components[$id]) : isset($this->_definitions[$id]);
    }

    /**
     * Returns the components instance with the specified ID.
     *
     * @param string $id components ID (e.g. `db`).
     * @param bool $throwException whether to throw an exception if `$id` is not registered with the locator before.
     * @return object|null the components of the specified ID. If `$throwException` is false and `$id`
     * is not registered before, null will be returned.
     * @throws InvalidConfigException if `$id` refers to a nonexistent components ID
     * @see has()
     * @see set()
     */
    public function get($id, $throwException = true)
    {
        if (isset($this->_components[$id])) {
            return $this->_components[$id];
        }

        if (isset($this->_definitions[$id])) {
            $definition = $this->_definitions[$id];
            if (is_object($definition) && !$definition instanceof Closure) {
                return $this->_components[$id] = $definition;
            }

            return $this->_components[$id] = Yii::createObject($definition);
        } elseif ($throwException) {
            throw new InvalidConfigException("Unknown components ID: $id");
        }

        return null;
    }

    /**
     * Registers a components definition with this locator.
     *
     * For example,
     *
     * ```php
     * // a class name
     * $locator->set('cache', 'yii\caching\FileCache');
     *
     * // a configuration array
     * $locator->set('db', [
     *     'class' => 'yii\db\Connection',
     *     'dsn' => 'mysql:host=127.0.0.1;dbname=demo',
     *     'username' => 'root',
     *     'password' => '',
     *     'charset' => 'utf8',
     * ]);
     *
     * // an anonymous function
     * $locator->set('cache', function ($params) {
     *     return new \yii\caching\FileCache;
     * });
     *
     * // an instance
     * $locator->set('cache', new \yii\caching\FileCache);
     * ```
     *
     * If a components definition with the same ID already exists, it will be overwritten.
     *
     * @param string $id components ID (e.g. `db`).
     * @param mixed $definition the components definition to be registered with this locator.
     * It can be one of the following:
     *
     * - a class name
     * - a configuration array: the array contains name-value pairs that will be used to
     *   initialize the property values of the newly created object when [[get()]] is called.
     *   The `class` element is required and stands for the the class of the object to be created.
     * - a PHP callable: either an anonymous function or an array representing a class method (e.g. `['Foo', 'bar']`).
     *   The callable will be called by [[get()]] to return an object associated with the specified components ID.
     * - an object: When [[get()]] is called, this object will be returned.
     *
     * @throws InvalidConfigException if the definition is an invalid configuration array
     */
    public function set($id, $definition)
    {
        unset($this->_components[$id]);

        if ($definition === null) {
            unset($this->_definitions[$id]);
            return;
        }

        if (is_object($definition) || is_callable($definition, true)) {
            // an object, a class name, or a PHP callable
            $this->_definitions[$id] = $definition;
        } elseif (is_array($definition)) {
            // a configuration array
            if (isset($definition['class'])) {
                $this->_definitions[$id] = $definition;
            } else {
                throw new InvalidConfigException("The configuration for the \"$id\" components must contain a \"class\" element.");
            }
        } else {
            throw new InvalidConfigException("Unexpected configuration type for the \"$id\" components: " . gettype($definition));
        }
    }

    /**
     * Removes the components from the locator.
     * @param string $id the components ID
     */
    public function clear($id)
    {
        unset($this->_definitions[$id], $this->_components[$id]);
    }

    /**
     * Returns the list of the components definitions or the loaded components instances.
     * @param bool $returnDefinitions whether to return components definitions instead of the loaded components instances.
     * @return array the list of the components definitions or the loaded components instances (ID => definition or instance).
     */
    public function getComponents($returnDefinitions = true)
    {
        return $returnDefinitions ? $this->_definitions : $this->_components;
    }

    /**
     * Registers a set of components definitions in this locator.
     *
     * This is the bulk version of [[set()]]. The parameter should be an array
     * whose keys are components IDs and values the corresponding components definitions.
     *
     * For more details on how to specify components IDs and definitions, please refer to [[set()]].
     *
     * If a components definition with the same ID already exists, it will be overwritten.
     *
     * The following is an example for registering two components definitions:
     *
     * ```php
     * [
     *     'db' => [
     *         'class' => 'yii\db\Connection',
     *         'dsn' => 'sqlite:path/to/file.db',
     *     ],
     *     'cache' => [
     *         'class' => 'yii\caching\DbCache',
     *         'db' => 'db',
     *     ],
     * ]
     * ```
     *
     * @param array $components components definitions or instances
     */
    public function setComponents($components)
    {
        foreach ($components as $id => $component) {
            $this->set($id, $component);
        }
    }
}
