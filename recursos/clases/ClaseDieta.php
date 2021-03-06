<?php
require_once '../db/db.php';    


/*/////////////////////////////
Clase Dieta
////////////////////////////*/

class DietaDAO 
{
    private $id;
    private $fecha;
    private $data;
    private $vigencia;


    public function __construct($id=null,$fecha=null,$data=null,$vigencia=null) {
        $this->id  = $id;
        $this->fecha  = $fecha;
        $this->data = $data;
        $this->vigencia = $vigencia;

}

        /*///////////////////////////////////////
        Guardar Dieta
        //////////////////////////////////////*/
        public function guardar_Dieta($id_cli, $id_coach) {

            try{

                
                $pdo = AccesoDB::getCon();




                $sql_dieta_ant = "update nut_dieta
                              set vig_nut_dieta = 0
                              where fk_dieta_cli = :cli";



                    $stmt = $pdo->prepare($sql_dieta_ant);
                            $stmt->bindParam("cli", $id_cli, PDO::PARAM_INT);
                    $stmt->execute();

                $sql_dieta = "INSERT INTO `smart_coach`.`nut_dieta`(`fec_nut_dieta`,`vig_nut_dieta`,
                                            `fk_dieta_coach`,`fk_dieta_cli`)
                                VALUES(:fec, :vig, :coach, :cli)";

                    $stmt = $pdo->prepare($sql_dieta);
                            $stmt->bindParam("fec", $this->fecha, PDO::PARAM_STR);
                            $stmt->bindParam("vig", $this->vigencia, PDO::PARAM_INT);
                            $stmt->bindParam("coach", $id_coach, PDO::PARAM_INT);
                            $stmt->bindParam("cli", $id_cli, PDO::PARAM_INT);
                    $stmt->execute();



                $sql= " SELECT id_nut_dieta FROM `nut_dieta` ORDER BY `id_nut_dieta` DESC LIMIT 1 ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $id = $stmt->fetchColumn();



                foreach ($this->data as $row) {
                              $com = $row['com'];
                              $ga = $row['ga'];
                              $ali = $row['ali'];
                              $med = $row['med'];
                              $nota = $row['nota'];
                              $cant = $row['cant'];

                         
                                  $sql_det_dieta = "INSERT INTO `smart_coach`.`nut_det_dieta`
                                  (`fk_nut_det_com`,`fk_nut_det_ga`,`fk_nut_det_ali`,`fk_nut_det_uni`,`fk_nut_dieta`
                                  ,`vig_nut_det`,`nota_nut_det`,`cant_nut_ali`)
                                  VALUES(:com, :ga, :ali, :med, :dieta, :vig, :nota, :cant)";



                                $stmt = $pdo->prepare($sql_det_dieta);
                                        $stmt->bindParam("com", $com, PDO::PARAM_INT);
                                        $stmt->bindParam("ga", $ga, PDO::PARAM_INT);
                                        $stmt->bindParam("ali", $ali, PDO::PARAM_INT);
                                        $stmt->bindParam("med", $med, PDO::PARAM_INT);
                                        $stmt->bindParam("dieta", $id, PDO::PARAM_INT);
                                        $stmt->bindParam("vig", $this->vigencia, PDO::PARAM_INT);
                                        $stmt->bindParam("nota", $nota, PDO::PARAM_STR);
                                        $stmt->bindParam("cant", $cant, PDO::PARAM_INT);
                                $stmt->execute();
                
                 }
        

            } catch (Exception $e) {
                 echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/carga_entrenamiento.php';</script>"; 
            }
        }




        /*///////////////////////////////////////
        Evaluar dieta
        //////////////////////////////////////*/
        public function eva_dieta($ham,$hora,$seg,$fec,$cli) {

            try{

                
                $pdo = AccesoDB::getCon();


               

                $sql_borg_rut = "INSERT INTO `smart_coach`.`eva_dieta`(`hambre_eva`,`horario_eva`,`seg_dieta_eva`,`fec_eva`,`fk_eva_dieta`,`fk_eva_cli`)
                    VALUES(:ham, :hora, :seg, :fec, :die, :cli)";



                $stmt = $pdo->prepare($sql_borg_rut);
                        $stmt->bindParam("ham", $ham, PDO::PARAM_INT);
                        $stmt->bindParam("hora", $hora, PDO::PARAM_INT);
                        $stmt->bindParam("seg", $seg, PDO::PARAM_INT);
                        $stmt->bindParam("fec", $fec, PDO::PARAM_STR);
                        $stmt->bindParam("die", $this->id, PDO::PARAM_INT);
                        $stmt->bindParam("cli", $cli, PDO::PARAM_INT);
                $stmt->execute();

        

            } catch (Exception $e) {
                 echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_cli/index_usu.php';</script>"; 
            }
        }




}
?>

