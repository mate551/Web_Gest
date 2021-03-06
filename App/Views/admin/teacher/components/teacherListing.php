<?php if (count($this->view->listTeacher) >= 1) { ?>

    <?php foreach ($this->view->listTeacher as $key => $teacher) { ?>

        <?php $photoDir =  "/assets/img/teacherProfilePhotos/" ?>

        <tr class="" id="teacher<?= $teacher->teacher_id ?>">

            <td class="text-right">
                <img src='<?= $teacher->profilePhoto == null ? $photoDir . "foto-vazia.jpg" : $photoDir . $teacher->profilePhoto ?>' alt="" style="width: 40px; height: 40px; object-position:top; object-fit: cover" onerror='this.src="<?= $photoDir . "foto-vazia.jpg" ?>"'>
            </td>

            <td class="text-left"><?= $teacher->teacher_name ?></td>

            <?php if ($this->view->typeTeacherList != 'class' && isset($this->view->typeTeacherList)) { ?>

            <?php

            $cpf = $teacher->teacher_cpf;

            $formattedCpf = substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, -2);

            ?>

            <td><?= $formattedCpf ?></td>

                <td><?= $teacher->teacher_sex ?></td>
                <td><?= $teacher->total_discipline ?></td>

            <?php } else { ?>

                <td class=""><?= $teacher->discipline_name ?></td>

            <?php } ?>
        </tr>

    <?php } ?>

    <tr class="mt-4">
        <td class="font-weight-bold" colspan="6"  style="pointer-events:none"><?= count($this->view->listTeacher) ?> docentes listados <i class="fas fa-history ml-2"></i></td>
    </tr>

<?php } else { ?>

    <tr class="mt-4 thead-light">
        <td class="ml-3" colspan="5" style="pointer-events:none">Nenhum professor encontrado </td>
    </tr>

<?php } ?>