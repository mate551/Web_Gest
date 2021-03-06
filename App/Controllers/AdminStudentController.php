<?php

namespace App\Controllers;

use App\Models\Student\Student;
use App\Models\Management\Classe;
use App\Models\Management\SchoolTerm;
use App\Models\Management\Course;
use App\Models\Student\StudentEnrollment;
use App\Models\People\Address;
use App\Models\People\Telephone;
use App\Models\Management\ClassDiscipline;
use App\Models\Management\Exam;
use App\Tools\Tools;
use MF\Controller\Action;
use MF\Model\Container;


class AdminStudentController extends Action
{

    public function studentRegistration()
    {

        $Student = Container::getModel('Student\\Student');
        $Classe = Container::getModel('Management\\Classe');

        $this->view->availableSex = $Student->availableSex();
        $this->view->pcd = $Student->pcd();
        $this->view->bloodType = $Student->bloodType();
        $this->view->availableClass = $Classe->availableListClass();

        $this->render('student/studentRegistration', 'AdminLayout');
    }


    public function studentList()
    {

        $Student = Container::getModel('Student\\Student');
        $Course = Container::getModel('Management\\Course');
        $Classe = Container::getModel('Management\\Classe');
        $Student = Container::getModel('Student\\Student');

        $this->view->listStudent = $Student->list('WHERE situacao_periodo_letivo.id_situacao_periodo_letivo = 1');
        $this->view->availableCourse = $Course->availableCourse();
        $this->view->availableClass = $Classe->availableListClass();
        $this->view->availableSex = $Student->availableSex();
        $this->view->availableShift = $Classe->availableShift();
        $this->view->availableSeries = $Classe->availableSeries();
        $this->view->typeStudentList = 'normal';

        $this->render('student/studentList', 'AdminLayout');
    }


    public function studentListing()
    {

        $Student = Container::getModel('Student\\Student');

        $this->view->listStudent = $Student->list();
        $this->view->typeStudentList = 'normal';

        $this->render('student/components/studentListing', 'SimpleLayout');
    }


    public function availableListClass()
    {

        $Classe = Container::getModel('Management\\Classe');

        $this->view->listClass = $Classe->availableListClass();

        $this->render('student/components/classesList', 'SimpleLayout');
    }


    public function studentSeek()
    {

        $Student = Container::getModel('Student\\Student');
        $Classe = Container::getModel('Management\\Classe');

        $Student->__set('name', $_GET['name']);
        $Student->__set('fk_id_sex', $_GET['sex']);
        $Classe->__set('fk_id_course', $_GET['course']);
        $Classe->__set('fk_id_series', $_GET['series']);
        $Classe->__set('fk_id_shift', $_GET['shift']);

        $this->view->listStudent = $Student->seek($Classe);
        $this->view->typeStudentList = 'normal';

        $this->render('student/components/studentListing', 'SimpleLayout');
    }


    public function studentProfile()
    {

        $Student = Container::getModel('Student\\Student');
        $Exam = Container::getModel('Management\\Exam');
        $ClassDiscipline = Container::getModel('Management\\ClassDiscipline');

        $Student->__set('id', empty($_GET['id']) ? $_POST['id'] : $_GET['id']);

        $this->view->studentProfile = $Student->profile();
        $this->view->availableSex = $Student->availableSex();
        $this->view->pcd = $Student->pcd();
        $this->view->unity = $Exam->unity();
        $this->view->bloodType = $Student->bloodType();
        $this->view->listAvailableExams = $Exam->examList('WHERE turma.id_turma = ' . $this->view->studentProfile[0]->class_id . ' ORDER BY disciplina.nome_disciplina ASC');

        $ClassDiscipline->__set("fk_id_class", $this->view->studentProfile[0]->class_id);

        $this->view->disciplinesClassAlreadyAdded = $ClassDiscipline->disciplinesClassAlreadyAdded(); 

        $this->render('student/components/modalStudentProfile', 'SimpleLayout');
    }


    public function updateStudentProfile()
    {

        $Address =  Container::getModel('People\\Address');
        $Telephone = Container::getModel('People\Telephone');
        $Student = Container::getModel('Student\\Student');

        $Address->__set('addressId', $_POST['addressId']);
        $Address->__set('district', $_POST['district']);
        $Address->__set('address', $_POST['address']);
        $Address->__set('uf', $_POST['uf']);
        $Address->__set('county', $_POST['county']);
        $Address->__set('zipCode', preg_replace('/[^0-9]/', '', $_POST['zipCode']));

        $Telephone->__set('telephoneId', $_POST['telephoneId']);
        $Telephone->__set('telephoneNumber', preg_replace('/[^0-9]/', '', $_POST['telephoneNumber']));

        $Student->__set('name', $_POST['name']);
        $Student->__set('birthDate', $_POST['birthDate']);
        $Student->__set('cpf', preg_replace('/[^0-9]/', '', $_POST['cpf']));
        $Student->__set('naturalness', $_POST['naturalness']);
        $Student->__set('nationality', $_POST['nationality']);
        $Student->__set('motherName', $_POST['motherName']);
        $Student->__set('fatherName', $_POST['fatherName']);
        $Student->__set('fk_id_sex', $_POST['sex']);
        $Student->__set('fk_id_blood_type', $_POST['bloodType']);
        $Student->__set('fk_id_pcd', $_POST['pcd']);
        $Student->__set('id', $_POST['studentId']);


        $Telephone->update();
        $Address->update();
        $Student->update();

        $this->view->studentProfile = $Student->profile();
        $this->view->availableSex = $Student->availableSex();
        $this->view->pcd = $Student->pcd();
        $this->view->bloodType = $Student->bloodType();

        $this->render('student/components/modalStudentProfile', 'SimpleLayout');
    }


    public function studentInsert()
    {

        $SchoolTerm = Container::getModel('Management\\SchoolTerm');
        $activeSchoolTerm = $SchoolTerm->active();

        $Tool = new Tools();

        $Address =  Container::getModel('People\\Address');
        $Telephone = Container::getModel('People\Telephone');
        $Student = Container::getModel('Student\\Student');
        $Enrollment = Container::getModel('Student\\StudentEnrollment');


        $Address->__set('district', $_POST['district']);
        $Address->__set('address', $_POST['address']);
        $Address->__set('uf', $_POST['uf']);
        $Address->__set('county', $_POST['county']);
        $Address->__set('zipCode', $Tool->formatElement($_POST['zipCode']));


        $Telephone->__set('telephoneNumber', $Tool->formatElement($_POST['telephoneNumber']));


        $Student->__set('name', $_POST['name']);
        $Student->__set('birthDate', $_POST['birthDate']);
        $Student->__set('cpf', $Tool->formatElement($_POST['cpf']));
        $Tool->image($Student, '../public/assets/img/studentProfilePhotos/');
        $Student->__set('naturalness', $_POST['naturalness']);
        $Student->__set('nationality', $_POST['nationality']);
        $Student->__set('motherName', $_POST['motherName']);
        $Student->__set('fatherName', $_POST['fatherName']);
        $Student->__set('fk_id_sex', $_POST['sex']);
        $Student->__set('fk_id_blood_type', $_POST['bloodType']);
        $Student->__set('fk_id_pcd', $_POST['pcd']);
        $Student->__set('fk_id_telephone', $Telephone->insert());
        $Student->__set('fk_id_address', $Address->insert());


        $Enrollment->__set('fk_id_student_situation', 1);
        $Enrollment->__set('fk_id_student', $Student->insert());
        $Enrollment->__set('fk_id_class', $_POST['class']);
        $Enrollment->__set('fk_id_school_term', $activeSchoolTerm[0]->option_value);


        $Enrollment->insert();


        header('Location: /admin/aluno/cadastro');
    }


    public function updateStudentProfilePicture()
    {

        $Student = Container::getModel('Student\\Student');

        $Tool = new Tools();

        empty($_GET['oldPhoto']) ? '' : unlink('../public/assets/img/studentProfilePhotos/' . $_POST['oldPhoto']);

        $Tool->image($Student, '../public/assets/img/studentProfilePhotos/');

        $Student->__set('id', $_POST['id']);

        $Student->updateProfilePicture();
    }
}
