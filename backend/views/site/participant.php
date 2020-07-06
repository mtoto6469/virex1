

<div class="participant col-sm-10">

    <h1>Participants</h1>
    <div id="">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th><a href="">ID</a></th>
                <th><a href="">نام کشور</a></th>
                <th><a href="">نام نمایشگاه</a></th>
                <th><a href="">نام شرکت</a></th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <?php
            if ($participant != null){
                foreach ($participant as $p){?>
           <td><?= $p->id; ?></td><td><?= $p->id_country ?></td><td><?= $p->id_exhibitionn ?></td><td><?=  $p->id_company?></td>
                    <?php
              }
            }else{?>

                    <td colspan="<td colspan="7"><div class="empty">هیچ غرفه ای ثبت نشده است.</div></td>"><div class=""></div></td>
              <?php
            }
            ?>
            </tr>
            </tbody>
        </table>
    </div>

  </div>