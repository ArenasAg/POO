<?php
include_once('../db/db.php');


class crud extends db {

    private $username;
    private $password;
    private $fname;
    private $fsurname;
    private $ssurname;
    private $birth;
    private $document;
    private $group;
    private $rfname;
    private $rfsurname;
    private $rssurname;
    private $rdocument;
    private $phone;

    function login($username, $password){
        $db = $this->connect();

        $this->username = $username;
        $this->password = $password;

        $consult = $db->prepare('SELECT * FROM user WHERE username = :username AND password = :password');
        $consult->bindParam('username', $this->username);
        $consult->bindParam('password', $this->password);
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

    function insert($fname, $fsurname, $ssurname, $birth, $document, $group, $rfname, $rfsurname, $rssurname, $rdocument, $phone){
        $db = $this->connect();

        $this->fname = $fname;
        $this->fsurname = $fsurname;
        $this->ssurname = $ssurname;
        $this->birth = $birth;
        $this->document = $document;
        $this->group = $group;

        $this->rfname = $rfname;
        $this->rfsurname = $rfsurname;
        $this->rssurname = $rssurname;
        $this->rdocument = $rdocument;
        $this->phone = $phone;

        $consult = $db->prepare('SELECT * FROM student WHERE document = :document');
        $consult->bindParam('document', $this->document);
        $consult->execute();

        if ($consult->rowCount() > 0) {
            setcookie("exists","true", time()+3600, "/");
            header("Location: ../Insert.php");
            exit();
        }else{
            $insertResponsible = $db->prepare("INSERT INTO responsible (fname, fsurname, ssurname, document, phone) VALUES (:fname, :fsurname, :ssurname, :document, :phone)");
            $insertResponsible->bindParam('fname', $this->rfname);
            $insertResponsible->bindParam('fsurname', $this->rfsurname);
            $insertResponsible->bindParam('ssurname', $this->rssurname);
            $insertResponsible->bindParam('document', $this->rdocument);
            $insertResponsible->bindParam('phone', $this->phone);
            $insertResponsible->execute();

            $idResponsible = $db->prepare('SELECT id FROM responsible WHERE document = :document');
            $idResponsible->bindParam('document', $this->rdocument);
            $idResponsible->execute();
            $id = $idResponsible->fetch();

            $insertStudent = $db->prepare("INSERT INTO student (fname, fsurname, ssurname, birth, document, grp, fk_responsible) VALUES (:fname, :fsurname, :ssurname, :birth, :document, :group, :id)");
            $insertStudent->bindParam('fname', $this->fname);
            $insertStudent->bindParam('fsurname', $this->fsurname);
            $insertStudent->bindParam('ssurname', $this->ssurname);
            $insertStudent->bindParam('birth', $this->birth);
            $insertStudent->bindParam('document', $this->document);
            $insertStudent->bindParam('group', $this->group);
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

    function search($search){
        $db = $this->connect();

        $consult = $db->prepare("SELECT * FROM student WHERE CONCAT(id, fname, fsurname, ssurname, birth, document, grp) LIKE :search");
        $consult->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
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

    function update($id, $fname, $fsurname, $ssurname, $birth, $document, $group, $rfname, $rfsurname, $rssurname, $rdocument, $phone){
        $db = $this->connect();

        $this->fname = $fname;
        $this->fsurname = $fsurname;
        $this->ssurname = $ssurname;
        $this->birth = $birth;
        $this->document = $document;
        $this->group = $group;

        $this->rfname = $rfname;
        $this->rfsurname = $rfsurname;
        $this->rssurname = $rssurname;
        $this->rdocument = $rdocument;
        $this->phone = $phone;

        $updateResponsible = $db->prepare("UPDATE responsible SET fname = :fname, fsurname = :fsurname, ssurname = :ssurname, document = :document, phone = :phone WHERE id = :id");
        $updateResponsible->bindParam('fname', $this->rfname);
        $updateResponsible->bindParam('fsurname', $this->rfsurname);
        $updateResponsible->bindParam('ssurname',$this->rssurname);
        $updateResponsible->bindParam('document', $this->rdocument);
        $updateResponsible->bindParam('phone', $this->phone);
        $updateResponsible->bindParam('id', $id);
        $updateResponsible->execute();

        $updateStudent = $db->prepare("UPDATE student SET fname = :fname, fsurname = :fsurname, ssurname = :ssurname, birth = :birth, document = :document, grp = :grp, fk_responsible = :fk_responsible WHERE id = :id");
        $updateStudent->bindParam('fname', $this->rfname);
        $updateStudent->bindParam('fsurname', $this->rfname);
        $updateStudent->bindParam('ssurname', $this->rfname);
        $updateStudent->bindParam('birth', $this->rfname);
        $updateStudent->bindParam('document', $this->rfname);
        $updateStudent->bindParam('grp', $this->rfname);
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

    function Read(){
        $db = $this->connect();

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

    function Delete($id){
        $db = $this->connect();

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