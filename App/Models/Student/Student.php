<?php

namespace App\Models\Student;

use App\Models\People\People;

class Student extends People
{

    private $fatherName;
    private $motherName;


    public function __get($att)
    {
        return $this->$att;
    }


    public function __set($att, $newValue)
    {
        return $this->$att = $newValue;
    }


    public function insert()
    {

        $query =

            "INSERT INTO aluno 
            
            (nome_aluno, cpf_aluno, data_nascimento_aluno, naturalidade_aluno, foto_perfil_aluno,nacionalidade_aluno, nome_mae,nome_pai, fk_id_sexo_aluno,fk_id_tipo_sanguineo_aluno, fk_id_aluno_pcd, fk_id_endereco_aluno, fk_id_telefone_aluno) 

            VALUES 
            
            (:studentName, :cpf, :birthDate, :naturalness, :profilePhoto, :nationality, :motherName, :fatherName, :fk_id_sex, :fk_id_blood_type, :fk_id_pcd,:fk_id_address, :fk_id_telephone)
            
        ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':studentName', $this->__get('name'));
        $stmt->bindValue(':cpf', $this->__get('cpf'));
        $stmt->bindValue(':birthDate', $this->__get('birthDate'));
        $stmt->bindValue(':naturalness', $this->__get('naturalness'));
        $stmt->bindValue(':profilePhoto', $this->__get('profilePhoto'));
        $stmt->bindValue(':nationality', $this->__get('nationality'));
        $stmt->bindValue(':motherName', $this->__get('motherName'));
        $stmt->bindValue(':fatherName', $this->__get('fatherName'));
        $stmt->bindValue(':fk_id_sex', $this->__get('fk_id_sex'));
        $stmt->bindValue(':fk_id_blood_type', $this->__get('fk_id_blood_type'));
        $stmt->bindValue(':fk_id_pcd', $this->__get('fk_id_pcd'));
        $stmt->bindValue(':fk_id_address', $this->__get('fk_id_address'));
        $stmt->bindValue(':fk_id_telephone', $this->__get('fk_id_telephone'));

        $stmt->execute();

        return $this->db->lastInsertId();
    }


    public function update()
    {

        $query =

            "UPDATE aluno SET 
            
            nome_aluno = :studentName , 
            cpf_aluno = :cpf  , 
            naturalidade_aluno = :naturalness , 
            nacionalidade_aluno = :nationality , 
            nome_mae = :motherName , 
            nome_pai = :fatherName , 
            fk_id_sexo_aluno = :fk_id_sex , 
            fk_id_tipo_sanguineo_aluno = :fk_id_blood_type, 
            fk_id_aluno_pcd = :fk_id_pcd , 
            data_nascimento_aluno = :birthDate 
            
            WHERE id_aluno = :id 
        
        ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':studentName', $this->__get('name'));
        $stmt->bindValue(':cpf', $this->__get('cpf'));
        $stmt->bindValue(':birthDate', $this->__get('birthDate'));
        $stmt->bindValue(':naturalness', $this->__get('naturalness'));
        $stmt->bindValue(':nationality', $this->__get('nationality'));
        $stmt->bindValue(':motherName', $this->__get('motherName'));
        $stmt->bindValue(':fatherName', $this->__get('fatherName'));
        $stmt->bindValue(':fk_id_sex', $this->__get('fk_id_sex'));
        $stmt->bindValue(':fk_id_blood_type', $this->__get('fk_id_blood_type'));
        $stmt->bindValue(':fk_id_pcd', $this->__get('fk_id_pcd'));
        $stmt->bindValue(':id', $this->__get('id'));

        $stmt->execute();
    }


    public function list($operation = '')
    {

        return $this->speedingUp(

            "SELECT 
            
            aluno.id_aluno AS student_id , 
            aluno.nome_aluno AS student_name , 
            aluno.foto_perfil_aluno AS profilePhoto , 
            aluno.cpf_aluno AS student_cpf , 
            serie.sigla AS acronym_series , 
            cedula_turma.cedula AS class_ballot , 
            curso.sigla AS course , 
            turno.nome_turno AS shift ,
            situacao_aluno AS student_state
            
            FROM aluno 
            
            INNER JOIN matricula ON(aluno.id_aluno = matricula.fk_id_aluno) 
            INNER JOIN situacao_aluno ON(matricula.fk_id_situacao_aluno = situacao_aluno.id_stuacao_aluno)
            INNER JOIN turma ON(matricula.fk_id_turma_matricula = turma.id_turma) 
            INNER JOIN serie ON(turma.fk_id_serie = serie.id_serie) 
            INNER JOIN cedula_turma ON(turma.fk_id_cedula = cedula_turma.id_cedula_turma) 
            INNER JOIN curso ON(turma.fk_id_curso = curso.id_curso) 
            INNER JOIN turno ON(turma.fk_id_turno = turno.id_turno) 
            INNER JOIN periodo_letivo ON(turma.fk_id_periodo_letivo = periodo_letivo.id_ano_letivo)
            INNER JOIN situacao_periodo_letivo ON(periodo_letivo.fk_id_situacao_periodo_letivo = situacao_periodo_letivo.id_situacao_periodo_letivo)
            
            $operation
            
            ;"
        );
    }


    public function seek($classe)
    {


        $query =

            "SELECT 
            
            aluno.id_aluno AS student_id , 
            aluno.nome_aluno AS student_name , 
            aluno.foto_perfil_aluno AS profilePhoto , 
            aluno.cpf_aluno AS student_cpf , 
            serie.sigla AS acronym_series , 
            cedula_turma.cedula AS class_ballot , 
            curso.sigla AS course , 
            turno.nome_turno AS shift 
            
            FROM aluno 
            
            INNER JOIN matricula ON(aluno.id_aluno = matricula.fk_id_aluno) 
            INNER JOIN turma ON(matricula.fk_id_turma_matricula = turma.id_turma) 
            INNER JOIN serie ON(turma.fk_id_serie = serie.id_serie) 
            INNER JOIN cedula_turma ON(turma.fk_id_cedula = cedula_turma.id_cedula_turma) 
            INNER JOIN curso ON(turma.fk_id_curso = curso.id_curso) 
            INNER JOIN turno ON(turma.fk_id_turno = turno.id_turno) 

            WHERE

            CASE WHEN :fk_id_sex = 0 THEN aluno.fk_id_sexo_aluno <> :fk_id_sex ELSE aluno.fk_id_sexo_aluno = :fk_id_sex END

            AND

            CASE WHEN :fk_id_course = 0 THEN curso.id_curso <> :fk_id_course ELSE curso.id_curso = :fk_id_course END

            AND 

            CASE WHEN :fk_id_shift = 0 THEN turno.id_turno <> :fk_id_shift ELSE turno.id_turno = :fk_id_shift END
            
            AND

            CASE WHEN :fk_id_series = 0 THEN serie.id_serie <> :fk_id_series ELSE serie.id_serie = :fk_id_series END

            AND

            aluno.nome_aluno LIKE :studentName 
        
        ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':studentName', "%" . $this->__get('name') . "%", \PDO::PARAM_STR);
        $stmt->bindValue(':fk_id_sex', $this->__get('fk_id_sex'));
        $stmt->bindValue(':fk_id_course', $classe->__get('fk_id_course'));
        $stmt->bindValue(':fk_id_shift', $classe->__get('fk_id_shift'));
        $stmt->bindValue(':fk_id_series', $classe->__get('fk_id_series'));

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }


    public function profile()
    {

        $query =

            "SELECT 
            
            aluno.id_aluno AS student_id , 
            aluno.nome_aluno AS student_name , 
            aluno.cpf_aluno AS student_cpf , 
            sexo.id_sexo AS student_sex_id , 
            sexo.sexo AS student_sex , 
            aluno.data_nascimento_aluno AS student_birth_date , 
            aluno.naturalidade_aluno AS student_naturalness , 
            aluno.foto_perfil_aluno AS student_profile_photo , 
            aluno.nacionalidade_aluno AS student_nacionality , 
            aluno.nome_mae AS student_mother , 
            aluno.nome_pai AS student_father , 
            tipo_sanguineo.tipo_sanguineo AS blood_type , 
            tipo_sanguineo.id_tipo_sanguineo AS blood_type_id , 
            pcd.pcd AS student_pcd , 
            pcd.id_pcd AS student_pcd_id , 
            telefone.numero_telefone AS telephone_number , 
            endereco.id_endereco AS student_address_id , 
            endereco.cep AS student_zipCode , 
            endereco.bairro AS student_district , 
            endereco.endereco AS student_address , 
            endereco.uf AS student_uf , 
            endereco.municipio AS student_county , 
            serie.sigla AS acronym_series , 
            cedula_turma.cedula AS ballot , 
            curso.sigla AS course , 
            turno.nome_turno AS shift_name , 
            numero_sala_aula.numero_sala_aula AS number_classroom , 
            situacao_aluno.situacao_aluno as student_situation , 
            endereco.id_endereco as address_id , 
            telefone.id_telefone AS telephone_id ,
            turma.id_turma AS class_id,
            matricula.id_matricula AS enrollmentId

            FROM aluno 
            
            INNER JOIN sexo ON(aluno.fk_id_sexo_aluno = sexo.id_sexo) 
            INNER JOIN pcd ON(aluno.fk_id_aluno_pcd = pcd.id_pcd ) 
            INNER JOIN tipo_sanguineo ON(tipo_sanguineo.id_tipo_sanguineo = aluno.fk_id_tipo_sanguineo_aluno) 
            INNER JOIN telefone ON(aluno.fk_id_telefone_aluno = telefone.id_telefone) 
            INNER JOIN endereco ON(aluno.fk_id_endereco_aluno = endereco.id_endereco) 
            INNER JOIN matricula ON(aluno.id_aluno = matricula.fk_id_aluno) 
            INNER JOIN situacao_aluno ON(matricula.fk_id_situacao_aluno = situacao_aluno.id_stuacao_aluno) 
            INNER JOIN turma ON(matricula.fk_id_turma_matricula = turma.id_turma) 
            INNER JOIN serie ON(turma.fk_id_serie = serie.id_serie) 
            INNER JOIN curso ON(turma.fk_id_curso = curso.id_curso) 
            INNER JOIN cedula_turma ON(turma.fk_id_cedula = cedula_turma.id_cedula_turma) 
            INNER JOIN turno ON(turma.fk_id_turno = turno.id_turno) 
            INNER JOIN sala ON(turma.fk_id_sala = sala.id_sala) 
            INNER JOIN numero_sala_aula ON(sala.fk_id_numero_sala = numero_sala_aula.id_numero_sala_aula) 
            
            WHERE aluno.id_aluno = :id
        
        ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id', $this->__get('id'));

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }


    public function updateProfilePicture()
    {

        $query = "UPDATE aluno SET aluno.foto_perfil_aluno = :profilePhoto WHERE aluno.id_aluno = :id";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':profilePhoto', $this->__get('profilePhoto'));
        $stmt->bindValue(':id', $this->__get('id'));

        $stmt->execute();
    }
}
