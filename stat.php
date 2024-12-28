<div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-line fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">The Major</p>
                                    <h6 class="mb-0"><?php
                                                             if($varID == 1){echo "Annee Preparatoire";
                                                             }else if($varID == 2){echo "Informatique et Reseaux";
                                                             }else if($varID == 3){echo "Genie Civil";
                                                             }else if($varID == 4){echo "Finance et Audit";
                                                             }else if($varID == 5){echo "Informatique industrielle et Automatisme";} ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Total of Students</p>
                                    <h6 class="mb-0">
                                        <?php
                                        $varCount =student::selectCountStudentGrpFil('student', $connection->conn,$varID) ;
                                        
                                        echo $varCount." Students";
                                        
                                        
                                        ?>
                                </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-area fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">The number of teachers</p>
                                    <h6 class="mb-0">
                                    <?php
                                       
                                        $varCt = 0;
                                        $tchs=Teacher::SelectTeachersByRespId('teacher',$connection->conn,$varID);
                                        if(!empty($tchs)){
                                            $varCt += count($tchs);
                                            echo $varCt." Teacher(s)";
                                        }else{
                                            echo 0;
                                        }
                                        
                                        ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">The number of groups</p>
                                    <h6 class="mb-0">
                                        <?php
                                        $varCount1 = 0;
                                        $filieress=filiere::selectfiliereByAdminId('filiere',$connection->conn,$varID);
                                        if(!empty($filieress)){
                                            foreach( $filieress as $fl){
                                                $studentsss=student::selectStudentDistinctGroupe('student',$connection->conn,$fl['id_Filiere']);
                                                if(!empty($studentsss)){$varCount1 += count($studentsss);}
                                                else $varCount1=0;
                                                
                                                
                                            }
                                        }
                                        echo $varCount1." Group(s)";
                                        ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>