<?php
include_once('Class.php');


class crud extends StudentResponsibleLogin {

    function login($StudentResponsibleLogin){
        $db = $StudentResponsibleLogin->connect();

        $arrayLogin = $StudentResponsibleLogin->getLogin();

        $consult = $db->prepare('SELECT * FROM user WHERE username = :username AND password = :password');
        $consult->bindParam('username', $arrayLogin['username']);
        $consult->bindParam('password', $arrayLogin['password']);
        $consult->execute();

        if($consult->rowCount() == 0){
            setcookie("errorLogin","true", time()+3600, "/");
            header("Location: ../Index.php");
        }else{
            $result = $consult->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $row){
                
                if($row['t_user'] == 'admin'){
                    session_start();
                    $_SESSION['admin'] = $row['t_user'];
                    header("Location: ../Home.php");
                }else if($row['t_user'] == 'normal'){
                    session_start();
                    $_SESSION['normal'] = $row['t_user'];
                    header("Location: ../Home.php");
                }
            }
        }
    }

    function insert($StudentResponsibleLogin){
        $db = $StudentResponsibleLogin->connect();

        $arrayStudent = $StudentResponsibleLogin->getStudent();
        $arrayResponsible = $StudentResponsibleLogin->getResponsible();

        $consult = $db->prepare('SELECT * FROM student WHERE document = :document');
        $consult->bindParam('document', $arrayStudent['document']);
        $consult->execute();

        if ($consult->rowCount() > 0) {
            setcookie("exists","true", time()+3600, "/");
            header("Location: ../Insert.php");
            exit();
        }else{
            $insertResponsible = $db->prepare("INSERT INTO responsible (fname, fsurname, ssurname, document, phone) VALUES (:fname, :fsurname, :ssurname, :document, :phone)");
            $insertResponsible->bindParam('fname', $arrayResponsible['fname']);
            $insertResponsible->bindParam('fsurname', $arrayResponsible['fsurname']);
            $insertResponsible->bindParam('ssurname', $arrayResponsible['ssurname']);
            $insertResponsible->bindParam('document', $arrayResponsible['document']);
            $insertResponsible->bindParam('phone', $arrayResponsible['phone']);
            $insertResponsible->execute();

            $idResponsible = $db->prepare('SELECT id FROM responsible WHERE document = :document');
            $idResponsible->bindParam('document', $arrayResponsible['document']);
            $idResponsible->execute();
            $id = $idResponsible->fetch();

            $insertStudent = $db->prepare("INSERT INTO student (fname, fsurname, ssurname, birth, document, grp, fk_responsible) VALUES (:fname, :fsurname, :ssurname, :birth, :document, :group, :id)");
            $insertStudent->bindParam('fname', $arrayStudent['fname']);
            $insertStudent->bindParam('fsurname', $arrayStudent['fsurname']);
            $insertStudent->bindParam('ssurname', $arrayStudent['ssurname']);
            $insertStudent->bindParam('birth', $arrayStudent['birth']);
            $insertStudent->bindParam('document', $arrayStudent['document']);
            $insertStudent->bindParam('group', $arrayStudent['group']);
            $insertStudent->bindParam('id', $id['id']);
            $insertStudent->execute();

            if ($insertStudent->rowCount() > 0 && $insertResponsible->rowCount() > 0) {
                setcookie("insert","true", time()+3600, "/");
                header("Location: ../Insert.php");
                exit();
            } else {
                setcookie("error","true", time()+3600, "/");
                header("Location: ../Insert.php");
                exit();
            }
        }
    }

    function searchByDocument($StudentResponsibleLogin, $document){
        $db = $StudentResponsibleLogin->connect();

        $consult = $db->prepare("SELECT * FROM student WHERE document LIKE :document");
        $consult->bindValue(':document', '%' . $document . '%', PDO::PARAM_STR);
        $consult->execute();
        $resultStudent = $consult->fetchAll(PDO::FETCH_ASSOC);

        session_start();

        echo '<table class="w-100 text-center border">
                    <thead>
                        <tr>
                            <th class="border">Full Name</th>
                            <th class="border">First Surname</th>
                            <th class="border">Second Surname</th>
                            <th class="border">Birth Date</th>
                            <th class="border">Document</th>
                            <th class="border">Group</th>
                            <th class="border">Responsible</th>
                        </tr>
                    </thead>';
                foreach($resultStudent as $row){
                    echo "<tbody>
                            <tr>
                                <td class='d-none'>$row[id]</td>
                                <td>$row[fname]</td>
                                <td>$row[fsurname]</td>
                                <td>$row[ssurname]</td>
                                <td>$row[birth]</td>
                                <td>$row[document]</td>
                                <td>$row[grp]</td>";
                                $responsible = $db->prepare('SELECT * FROM responsible WHERE id = :id');
                                $responsible->bindParam('id', $row['id']);
                                $responsible->execute();
                                $resultResponsible = $responsible->fetch();
                                echo "<td >
                                            <button class='btn btn-secondary' onmouseover='mostrar(\"menu{$resultResponsible['id']}\")' onmouseout='ocultar(\"menu{$resultResponsible['id']}\")'>
                                                $resultResponsible[fname]
                                            </button>
                                            <div id='menu{$resultResponsible['id']}' class='d-none bg-light position-absolute' style='left: 59%'>
                                                    <table class='w-100 text-center'>
                                                        <thead class='border'>
                                                            <th class='border'>Full Name</th>
                                                            <th class='border'>First Surname</th>
                                                            <th class='border'>Second Surname</th>
                                                            <th class='border'>Document</th>
                                                            <th class='border'>Phone</th>
                                                        </thead>
                                                        <tbody class='border'>
                                                            <tr data-id='1'>
                                                                <td class='border'>$resultResponsible[fname]</td>
                                                                <td class='border'>$resultResponsible[fsurname]</td>
                                                                <td class='border'>$resultResponsible[ssurname]</td>
                                                                <td>$resultResponsible[document]</td>
                                                                <td class='border'>$resultResponsible[phone]</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                    </td>";
                                    if(isset($_SESSION['admin'])) {
                                        echo "<td>
                                            <form name='form' id='form' class='d-none' action='Update.php' method='post'>
                                                <input id='id' name='id' type='text'>
                                                <input id='fname' name='fname' type='text'>
                                                <input id='fsurname' name='fsurname' type='text'>
                                                <input id='ssurname' name='ssurname' type='text'>
                                                <input id='birth' name='birth' type='date'>
                                                <input id='document' name='document' type='text'>
                                                <input id='group' name='group' type='text'>
                                                <input id='rfname' name='rfname' type='text'>
                                                <input id='rfsurname' name='rfsurname' type='text'>
                                                <input id='rssurname' name='rssurname' type='text'>
                                                <input id='rdocument' name='rdocument' type='text'>
                                                <input id='phone' name='phone' type='text'>
                                            </form>
                                            <button class='update bg-transparent border-0' data-toggle='tooltip' title='Update'>
                                                <img style='width: 30px; height: 30px;' src='src/update.png'>
                                            </button>
                                        </td>
                                        <td>
                                            <button class='delete bg-transparent border-0' data-toggle='tooltip' title='Delete'>
                                                <img style='width: 30px; height: 30px;' src='src/delete.png'>
                                            </button>
                                        </td>";
                                    }
                        echo "</tr>
                    </tbody>";
        }
        echo '</table>';

    }

    function update($StudentResponsibleLogin, $id){
        $db = $StudentResponsibleLogin->connect();

        $arrayStudent = $StudentResponsibleLogin->getStudent();
        $arrayResponsible = $StudentResponsibleLogin->getResponsible();

        $updateResponsible = $db->prepare("UPDATE responsible SET fname = :fname, fsurname = :fsurname, ssurname = :ssurname, document = :document, phone = :phone WHERE id = :id");
        $updateResponsible->bindParam('fname', $arrayResponsible['fname']);
        $updateResponsible->bindParam('fsurname', $arrayResponsible['fsurname']);
        $updateResponsible->bindParam('ssurname', $arrayResponsible['ssurname']);
        $updateResponsible->bindParam('document', $arrayResponsible['document']);
        $updateResponsible->bindParam('phone', $arrayResponsible['phone']);
        $updateResponsible->bindParam('id', $id);
        $updateResponsible->execute();

        $updateStudent = $db->prepare("UPDATE student SET fname = :fname, fsurname = :fsurname, ssurname = :ssurname, birth = :birth, document = :document, grp = :grp, fk_responsible = :fk_responsible WHERE id = :id");
        $updateStudent->bindParam('fname', $arrayStudent['fname']);
        $updateStudent->bindParam('fsurname', $arrayStudent['fsurname']);
        $updateStudent->bindParam('ssurname', $arrayStudent['ssurname']);
        $updateStudent->bindParam('birth', $arrayStudent['birth']);
        $updateStudent->bindParam('document', $arrayStudent['document']);
        $updateStudent->bindParam('grp', $arrayStudent['group']);
        $updateStudent->bindParam('fk_responsible', $id);
        $updateStudent->bindParam('id', $id);
        $updateStudent->execute();

        if ($updateStudent->rowCount() > 0 || $updateResponsible->rowCount() > 0) {
            setcookie("update","true", time()+3600, "/");
            header("Location: ../Read.php");
            exit();
        } else {
            setcookie("errorUpdate","true", time()+3600, "/");
            header("Location: ../Read.php");
            exit();
        }
    }

    function Read($StudentResponsibleLogin){
        $db = $StudentResponsibleLogin->connect();

        $consult = $db->prepare('SELECT * FROM student');
        $consult->execute();
        $resultStudent = $consult->fetchAll(PDO::FETCH_ASSOC);

        session_start();

        echo '<table class="w-100 text-center border">
                    <thead>
                        <tr>
                            <th class="border">Full Name</th>
                            <th class="border">First Surname</th>
                            <th class="border">Second Surname</th>
                            <th class="border">Birth Date</th>
                            <th class="border">Document</th>
                            <th class="border">Group</th>
                            <th class="border">Responsible</th>
                        </tr>
                    </thead>';
                foreach($resultStudent as $row){
                    echo "<tbody>
                            <tr>
                                <td class='d-none'>$row[id]</td>
                                <td>$row[fname]</td>
                                <td>$row[fsurname]</td>
                                <td>$row[ssurname]</td>
                                <td>$row[birth]</td>
                                <td>$row[document]</td>
                                <td>$row[grp]</td>";

                                $responsible = $db->prepare('SELECT * FROM responsible WHERE id = :id');
                                $responsible->bindParam('id', $row['id']);
                                $responsible->execute();
                                $resultResponsible = $responsible->fetch();

                                echo "<td >
                                            <button class='btn btn-secondary' onmouseover='mostrar(\"menu{$resultResponsible['id']}\")' onmouseout='ocultar(\"menu{$resultResponsible['id']}\")'>
                                                $resultResponsible[fname]
                                            </button>
                                            <div id='menu{$resultResponsible['id']}' class='d-none bg-light position-absolute' style='left: 59%'>
                                                <table class='w-100 text-center'>
                                                    <thead class='border'>
                                                        <th class='border'>Full Name</th>
                                                        <th class='border'>First Surname</th>
                                                        <th class='border'>Second Surname</th>
                                                        <th class='border'>Document</th>
                                                        <th class='border'>Phone</th>
                                                    </thead>
                                                    <tbody class='border'>
                                                        <tr data-id='1'>
                                                            <td class='border'>$resultResponsible[fname]</td>
                                                            <td class='border'>$resultResponsible[fsurname]</td>
                                                            <td class='border'>$resultResponsible[ssurname]</td>
                                                            <td>$resultResponsible[document]</td>
                                                            <td class='border'>$resultResponsible[phone]</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </td>";
                                    if(isset($_SESSION['admin'])) {
                                        echo "<td>
                                            <form name='form' id='form' class='d-none' action='Update.php' method='post'>
                                                <input id='id' name='id' type='text'>
                                                <input id='fname' name='fname' type='text'>
                                                <input id='fsurname' name='fsurname' type='text'>
                                                <input id='ssurname' name='ssurname' type='text'>
                                                <input id='birth' name='birth' type='date'>
                                                <input id='document' name='document' type='text'>
                                                <input id='group' name='group' type='text'>
                                                <input id='rfname' name='rfname' type='text'>
                                                <input id='rfsurname' name='rfsurname' type='text'>
                                                <input id='rssurname' name='rssurname' type='text'>
                                                <input id='rdocument' name='rdocument' type='text'>
                                                <input id='phone' name='phone' type='text'>
                                            </form>
                                            <button class='update bg-transparent border-0' data-toggle='tooltip' title='Update'>
                                                <img style='width: 30px; height: 30px;' src='src/update.png'>
                                            </button>
                                        </td>
                                        <td>
                                            <button class='delete bg-transparent border-0' data-toggle='tooltip' title='Delete'>
                                                <img style='width: 30px; height: 30px;' src='src/delete.png'>
                                            </button>
                                        </td>";
                                    }
                        echo "</tr>
                    </tbody>";
        }
        echo '</table>';
    }

    function Delete($StudentResponsibleLogin, $id){
        $db = $StudentResponsibleLogin->connect();

        $consult = $db->prepare('DELETE FROM student WHERE id = :id');
        $consult->bindParam('id', $id);
        $responsible = $db->prepare('DELETE FROM responsible WHERE id = :id');
        $responsible->bindParam('id', $id);
        $consult->execute();
        $responsible->execute();

        if ($consult->rowCount() > 0 && $responsible->rowCount() > 0) {
            setcookie("delete","true", time()+3600, "/");
        }else{
            setcookie("errorDelete","true", time()+3600, "/");
        }

    }
}

?>