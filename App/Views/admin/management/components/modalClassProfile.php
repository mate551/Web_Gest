<div class="row mb-4 d-flex justify-content-around" id="main-accordion">



    <div class="col-lg-3 col-11 mx-auto">

        <div class="row card">

            <div class="col-lg-12 container-list-group">

                <div class="row">

                    <nav>

                        <ul>

                            <a class="collapse show" href="#" data-toggle="collapse" aria-expanded="true" data-target="#accordion-class-data">Dados da turma</a>

                            <a class="collapsed" href="#" data-toggle="collapse" aria-expanded="false" data-target="#class-discipline-accordion">Disciplinas</a>

                            <a class="collapsed" href="#" data-toggle="collapse" aria-expanded="false" data-target="#class-profile-assessments">Avaliações</a>

                        </ul>

                    </nav>
                </div>
            </div>

            <div class="col-lg-12">

                <div class="row p-3 text-secondary main-sheet">

                    <div class="col-lg-12">

                        <div class="row">

                            <span class="col-12 mx-auto"><?= $this->view->classData[0]->series_acronym ?>ª <?= $this->view->classData[0]->ballot ?> <?= $this->view->classData[0]->course ?> <?= $this->view->classData[0]->shift ?> - Período letivo 2021</span>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-8 card main-content col-11 mx-auto">

        <div class="row">

            <div class="col-lg-11 mx-auto collapse show" id="accordion-class-data" data-parent="#main-accordion">

                <div class="col-lg-12 mb-4 mt-4">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-6">
                            <h5><?= $this->view->classData[0]->series_acronym ?>ª <?= $this->view->classData[0]->ballot ?> <?= $this->view->classData[0]->course ?> <?= $this->view->classData[0]->shift ?></h5>
                        </div>

                        <div class="col-lg-6 col-12 collapse-options-container">

                            <a class="font-weight-bold" aria-expanded="true" data-toggle="collapse" data-target="#students-list"><span class="mr-2"><i class="fas fa-user-friends"></i> Alunos</span></a>

                            <a class="collapsed font-weight-bold" aria-expanded="false" data-toggle="collapse" data-target="#teacher-list" routeData="<?= $this->view->classId ?>"><span class="mr-2"><i class="fas fa-chalkboard-teacher"></i> Professores</span></a>


                        </div>
                    </div>
                </div>

                <div class="col-lg-12">

                    <div class="row mb-3">

                        <div class="collapse show card col-lg-12" id="students-list" data-parent="#accordion-class-data">
                            <div class="row">
                                <div class="col-lg-12 table-responsive">

                                    <table class="table col-lg-12 table-hover mt-3 table-borderless ">

                                        <tbody containerListStudent class="">

                                            <?php require '../App/Views/admin/student/components/studentListing.php' ?>

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>

                        <div class="collapse col-lg-12 card" id="teacher-list" data-parent="#accordion-class-data">
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table col-lg-12 table-hover mt-3 table-borderless ">

                                        <tbody containerListTeacher class="">

                                            <?php require '../App/Views/admin/teacher/components/teacherListing.php' ?>

                                        </tbody>


                                    </table>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-11 mx-auto collapse" id="class-discipline-accordion" data-parent="#main-accordion">

                <div class="col-lg-12 mb-4 mt-4">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-5">
                            <h5>Disciplinas</h5>
                        </div>

                        <div class="col-lg-7 col-12 collapse-options-container">

                            <a class="font-weight-bold" aria-expanded="true" data-toggle="collapse" data-target="#list-discipline"><span class="mr-2"><i class="fas fa-boxes mr-2"></i> Disciplinas</span></a>

                            <a class="collapsed font-weight-bold" aria-expanded="false" data-toggle="collapse" data-target="#add-discipline"><span class="mr-2 "><i class="fas fa-plus-circle mr-2"></i> Adicionar</span></a>


                        </div>


                    </div>
                </div>

                <div class="col-lg-12">

                    <div class="row mb-3">

                        <div class="col-lg-12">
                            <div class="collapse show" id="list-discipline" data-parent="#class-discipline-accordion">
                                <div class="row" containerListDisciplineClass>

                                    <?php require '../App/Views/admin/management/components/disciplineClass.php' ?>

                                </div>

                            </div>


                            <div class="collapse card" id="add-discipline" data-parent="#class-discipline-accordion">
                                <div class="row">

                                    <form class="col-lg-11 mx-auto" id="addClassDiscipline" action="">

                                        <div class="form-row mt-3">

                                            <div class="form-group col-lg-6">

                                                <label for="">Professor:</label>

                                                <select id="teacher" name="teacher" class="form-control custom-select" required>

                                                    <?php foreach ($this->view->teacherAvailable as $key => $teacher) { ?>

                                                        <option value="<?= $teacher->option_value ?>"><?= $teacher->option_text ?></option>

                                                    <?php } ?>

                                                </select>

                                            </div>

                                            <input type="hidden" name="classId" value="<?= $this->view->classId ?>">

                                            <div class="form-group col-lg-6">

                                                <label for="">Disciplina</label>

                                                <select id="availableSubjects" name="availableSubjects" class="form-control custom-select" required></select>

                                            </div>

                                        </div>

                                        <div class="form-row d-flex justify-content-end">

                                            <div class="form-group col-lg-5">
                                                <label for="">&nbsp;</label>
                                                <button id="buttonAddClassDiscipline" class="btn btn-success w-100">Adicionar disciplina</button>
                                            </div>

                                        </div>


                                </div>


                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-11 mx-auto collapse" id="class-profile-assessments" data-parent="#main-accordion">

                <div class="accordion" id="class-assessments-accordion">

                    <div class="col-lg-12 mb-4 mt-3">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-5">
                                <h5>Avaliações da turma</h5>
                            </div>

                            <div class="col-lg-7 col-12 collapse-options-container">

                                <a class="font-weight-bold" aria-expanded="true" data-toggle="collapse" data-target="#list-exam"><span class="mr-2 "><i class="fas fa-boxes mr-2"></i> Avaliações</span></a>

                                <a class="collapsed font-weight-bold" aria-expanded="false" data-toggle="collapse" data-target="#add-assessments"><span class="mr-2"><i class="fas fa-plus-circle mr-2"></i> Adicionar</span></a>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 card">

                        <div class="collapse show" id="list-exam" data-parent="#class-assessments-accordion">

                            <form id="seekExam" class="text-dark col-lg-12 mx-auto mt-3" action="">

                                <div class="form-row mt-3">

                                    <div class="form-group col-lg-5">
                                        <label for="">Descrição:</label>
                                        <input name="examDescription" id="examDescription" type="text" placeholder="Nome da avaliação" class="form-control">
                                    </div>

                                    <input type="hidden" value="<?= $this->view->classId ?>" name="classId">

                                    <div class="form-group col-lg-4">

                                        <label for="">Disciplina:</label>

                                        <select id="disciplineClassId" class="form-control custom-select" name="disciplineClassId" required>

                                            <option value="0">Todas</option>

                                            <?php foreach ($this->view->disciplinesClassAlreadyAdded as $key => $discipline) { ?>

                                                <option value="<?= $discipline->option_value ?>"><?= $discipline->option_text ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="">Unidade:</label>

                                        <select id="unity" class="form-control custom-select" name="unity" required>

                                            <option value="0">Todas</option>

                                            <?php foreach ($this->view->unity as $key => $unity) { ?>

                                                <option value="<?= $unity->option_value ?>"><?= $unity->option_text ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                </div>

                            </form>


                            <div containerExamsList class="">

                                <?php require '../App/Views/admin/management/components/examList.php' ?>

                            </div>

                        </div>

                        <div class="collapse" id="add-assessments" data-parent="#class-assessments-accordion">

                            <form id="addExam" class="col-lg-11 mx-auto">

                                <div class="form-row mt-3">

                                    <div class="form-group col-lg-6">

                                        <label for="">Descrição da avaliação:</label>
                                        <input class="form-control" id="examDescription" name="examDescription" type="text">

                                    </div>

                                    <div class="form-group col-lg-6">

                                        <label for="">Disciplina:</label>

                                        <select id="disciplineClassId" class="form-control custom-select" name="disciplineClassId" required>

                                            <?php foreach ($this->view->disciplinesClassAlreadyAdded as $key => $discipline) { ?>

                                                <option value="<?= $discipline->option_value ?>"><?= $discipline->option_text ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-lg-5">
                                        <label for="">Data de realização:</label>
                                        <input class="form-control" name="realizeDate" id="realizeDate" type="date">
                                    </div>

                                    <div class="form-group col-lg-2">
                                        <label for="">Valor:</label>
                                        <input class="form-control" value="0.0" name="examValue" id="examValue" type="text">
                                    </div>

                                    <div class="form-group col-lg-2">
                                        <label for="">Unidade:</label>

                                        <select id="unity" class="form-control custom-select" name="unity" required>

                                            <?php foreach ($this->view->unity as $key => $unity) { ?>

                                                <option value="<?= $unity->option_value ?>"><?= $unity->option_text ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                    <div class="form-group col-lg-3 ml-auto">
                                        <label for="">&nbsp;</label>
                                        <button id="buttonAddExam" class="btn btn-success w-100">Adicionar</button>
                                    </div>

                                </div>

                            </form>

                            <div containerListExam></div>

                        </div>


                    </div>
                </div>

                <form id="formClassId" action="">

                    <input type="hidden" value="<?= $this->view->classId ?>" name="classId">

                </form>

              

            </div>
        </div>
    </div>
</div>