<?php

namespace App\Models\Management;

use App\Models\Management\Exam;

class Note extends Exam
{

    private $noteId;
    private $noteValue;
    private $fk_id_exam;
    private $fk_id_student_enrollment;
    private $fk_id_class;


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

            "INSERT INTO nota_avaliacao (valor_nota , fk_id_avaliacao , fk_id_matricula_aluno) 
            
            VALUES 
            
            (:noteValue , :fk_id_exam , :fk_id_student_enrollment)
        
        ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':noteValue', $this->__get('noteValue'));
        $stmt->bindValue(':fk_id_exam', $this->__get('fk_id_exam'));
        $stmt->bindValue(':fk_id_student_enrollment', $this->__get('fk_id_student_enrollment'));

        $stmt->execute();
    }




    public function list($operation = "")
    {

        $query =

            "SELECT 

            avaliacoes.descricao_avaliacao AS exam_description , 
            disciplina.nome_disciplina AS discipline_name , 
            avaliacoes.valor_avaliacao AS exam_value , 
            nota_avaliacao.valor_nota AS note_value ,
            unidade.unidade AS unity ,
            nota_avaliacao.id_nota AS note_id ,
            avaliacoes.id_avaliacao AS exam_id ,
            avaliacoes.data_realizada AS realize_date ,
            professor.nome_professor AS teacher_name ,
            matricula.id_matricula AS enrollment_id
      
            FROM avaliacoes
            
            INNER JOIN turma_disciplina ON(avaliacoes.fk_turma_disciplina_avaliacao = turma_disciplina.id_turma_disciplina)
            INNER JOIN professor ON(turma_disciplina.fk_id_professor = professor.id_professor)
            INNER JOIN disciplina ON(turma_disciplina.fk_id_disciplina = disciplina.id_disciplina)
            INNER JOIN nota_avaliacao ON(avaliacoes.id_avaliacao = nota_avaliacao.fk_id_avaliacao)
            INNER JOIN matricula ON(nota_avaliacao.fk_id_matricula_aluno = matricula.id_matricula)
            INNER JOIN unidade ON(avaliacoes.fk_id_unidade_avaliacao = unidade.id_unidade)
            
            $operation
            
        ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':fk_id_student_enrollment', $this->__get('fk_id_student_enrollment'));

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }


    public function examsPerformed($operation = '')
    {

        $query =

            "SELECT 
            
            avaliacoes.id_avaliacao AS exam_id , 
            avaliacoes.descricao_avaliacao AS exam_description , 
            aluno.nome_aluno AS student_name , 
            avaliacoes.valor_avaliacao AS exam_value , 
            nota_avaliacao.valor_nota AS note_value 

            FROM aluno 
            
            LEFT JOIN matricula ON(aluno.id_aluno = matricula.fk_id_aluno) 
            LEFT JOIN nota_avaliacao ON(matricula.id_matricula = nota_avaliacao.fk_id_matricula_aluno) 
            LEFT JOIN avaliacoes ON(nota_avaliacao.fk_id_avaliacao = avaliacoes.id_avaliacao)
            
            $operation 
            
        ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':fk_id_student_enrollment', $this->__get('fk_id_student_enrollment'));

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }


    public function seek()
    {

        $query =

            "SELECT 

            avaliacoes.descricao_avaliacao AS exam_description , 
            disciplina.nome_disciplina AS discipline_name , 
            avaliacoes.valor_avaliacao AS exam_value , 
            nota_avaliacao.valor_nota AS note_value ,
            unidade.unidade AS unity ,
            nota_avaliacao.id_nota AS note_id ,
            avaliacoes.id_avaliacao AS exam_id 
      
            FROM avaliacoes
            
            INNER JOIN turma_disciplina ON(avaliacoes.fk_turma_disciplina_avaliacao = turma_disciplina.id_turma_disciplina)
            INNER JOIN disciplina ON(turma_disciplina.fk_id_disciplina = disciplina.id_disciplina)
            INNER JOIN nota_avaliacao ON(avaliacoes.id_avaliacao = nota_avaliacao.fk_id_avaliacao)
            INNER JOIN matricula ON(nota_avaliacao.fk_id_matricula_aluno = matricula.id_matricula)
            INNER JOIN unidade ON(avaliacoes.fk_id_unidade_avaliacao = unidade.id_unidade)
            INNER JOIN turma ON(turma_disciplina.fk_id_turma = turma.id_turma)

            WHERE avaliacoes.descricao_avaliacao LIKE :examDescription 

            AND

            CASE WHEN :fk_id_discipline_class = 0 THEN turma.id_turma = :fk_id_class ELSE avaliacoes.fk_turma_disciplina_avaliacao = :fk_id_discipline_class END

            AND

            CASE WHEN :fk_id_exam_unity = 0 THEN avaliacoes.fk_id_unidade_avaliacao <> :fk_id_exam_unity ELSE avaliacoes.fk_id_unidade_avaliacao = :fk_id_exam_unity END

            AND matricula.id_matricula = :fk_id_student_enrollment
                  
        ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':fk_id_student_enrollment', $this->__get('fk_id_student_enrollment'));
        $stmt->bindValue(':examDescription', "%" . $this->__get('examDescription') . "%", \PDO::PARAM_STR);
        $stmt->bindValue(':fk_id_exam_unity', $this->__get('fk_id_exam_unity'));
        $stmt->bindValue(':fk_id_class', $this->__get('fk_id_class'));
        $stmt->bindValue(':fk_id_discipline_class', $this->__get('fk_id_discipline_class'));

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }


    public function update()
    {

        $query = "UPDATE nota_avaliacao SET nota_avaliacao.valor_nota = :note_value WHERE nota_avaliacao.id_nota = :note_id ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':note_value', $this->__get('noteValue'));
        $stmt->bindValue(':note_id', $this->__get('noteId'));

        $stmt->execute();
    }


    public function delete()
    {

        $query = "DELETE FROM nota_avaliacao WHERE nota_avaliacao.id_nota = :note_id ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':note_id', $this->__get('noteId'));

        $stmt->execute();
    }


    public function notesNotAddedYet()
    {

        $allExamsClass =

            "SELECT 

            avaliacoes.id_avaliacao AS exam_id, 
            avaliacoes.descricao_avaliacao AS exam_description,
            disciplina.nome_disciplina AS discipline_name, 
            avaliacoes.data_realizada AS realize_date, 
            avaliacoes.valor_avaliacao AS exam_value, 
            unidade.unidade AS unity 

            FROM avaliacoes

            LEFT JOIN turma_disciplina ON(avaliacoes.fk_turma_disciplina_avaliacao = turma_disciplina.id_turma_disciplina) 
            LEFT JOIN disciplina ON(turma_disciplina.fk_id_disciplina = disciplina.id_disciplina) 
            LEFT JOIN unidade ON(avaliacoes.fk_id_unidade_avaliacao = unidade.id_unidade)
            
            WHERE turma_disciplina.fk_id_turma = :fk_id_class
            
        ";

        $stmt = $this->db->prepare($allExamsClass);
        $stmt->bindValue(':fk_id_class', $this->__get('fk_id_class'));
        $stmt->execute();

        $allExamsClass = $stmt->fetchAll(\PDO::FETCH_OBJ);

        $allStudentExams =

            "SELECT 

            avaliacoes.id_avaliacao AS exam_id

            FROM avaliacoes
			
            LEFT JOIN nota_avaliacao ON(avaliacoes.id_avaliacao = nota_avaliacao.fk_id_avaliacao)
            LEFT JOIN matricula ON(nota_avaliacao.fk_id_matricula_aluno = matricula.id_matricula) 

            WHERE nota_avaliacao.fk_id_matricula_aluno = :fk_id_student_enrollment;

        ";

        $stmt = $this->db->prepare($allStudentExams);
        $stmt->bindValue(':fk_id_student_enrollment', $this->__get('fk_id_student_enrollment'));
        $stmt->execute();

        $allStudentExams = $stmt->fetchAll(\PDO::FETCH_OBJ);

        $allExamId = [];
        $availableNote = [];

        foreach ($allStudentExams as $key => $exam) {
            array_push($allExamId, $exam->exam_id);
        }

        foreach ($allExamsClass as $key => $exam) {

            if (!in_array($exam->exam_id, $allExamId)) {

                $pointsOrTenths = $exam->exam_value > 1 ? " pontos" : " décimos";

                $description = $exam->discipline_name . ' - ' . $exam->exam_description . ' - ' . $exam->unity . ' unidade - ' . $exam->exam_value . $pointsOrTenths;

                array_push($availableNote, array("option_value" => $exam->exam_id, "option_text" => $description));
            }
        }

        return $availableNote;
    }
}
