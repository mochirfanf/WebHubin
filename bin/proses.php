<?php

    include "koneksidb.php";

    function anti_injection($param){
        $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
        return $filter;
    }

    if (!empty($_GET ["a"])) {
        switch ($_GET ["a"]){
            case "login":
                $username = anti_injection($_POST['username']);
                $password = anti_injection($_POST['password']);
                $password = md5($password);

                $useradmin  = mysql_query("SELECT * FROM hb_user_admin WHERE username='$username' AND password='$password'");
                $ruseradmin = mysql_fetch_row($useradmin);

                $kapprog = mysql_query("SELECT * FROM jurusan WHERE kapprog = '$username'");
                $rkapprog = mysql_fetch_row($kapprog);

                $siswa = mysql_query("SELECT * FROM siswa WHERE nis = '$username'");
                $rsiswa = mysql_fetch_row($siswa);

                $guru = mysql_query("SELECT * FROM guru WHERE nip_guru = '$username'");
                $rguru = mysql_fetch_row($guru);

                $userperusahaan  = mysql_query("SELECT * FROM hb_du_umum WHERE username='$username' AND password='$password' AND level='perusahaan' AND status='aktif' ");
                $ruserperusahaan = mysql_fetch_row($userperusahaan);

                if($ruseradmin>0){

                    $c      = mysql_fetch_array(mysql_query("SELECT * FROM hb_user_admin WHERE username='$username' and password='$password'"));
                    $level  = $c['level'];
                    $status = $c['status'];

                    if($level=="super_admin" AND $status=="aktif"){
                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = $level;
                        $_SESSION['password'] = $password;

                        header("location:super_admin/index.php");
                    }
                    if($level=="admin" AND $status=="aktif"){
                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = $level;
                        $_SESSION['password'] = $password;
                        $_SESSION['tahun_ajaran'] = '';

                        $d=mysql_fetch_array(mysql_query("SELECT * FROM hb_pengelola_hubin WHERE username='$username'"));
                        $_SESSION['nip'] = $d["nip"];
                        header("location:admin/index.php");
                    }

                }

                elseif($rkapprog > 0) {

                    $c  = mysql_fetch_array( mysql_query("SELECT * FROM hb_login_operator WHERE nip_nis = '$username' and password='$password'"));
                    $_SESSION['level'] = "kapprog";
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;

                    $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE kapprog = '$username'"));
                    $_SESSION['jurusan'] = $j["id_jurusan"];

                    header("location:kapprog/index.php");

                }

                elseif($rsiswa > 0) {

                    $c  = mysql_query("SELECT * FROM hb_login_operator WHERE nip_nis = '$username' and password='$password'");
                    $crow = mysql_fetch_row($c);

                    if ($crow>0) {
                        $_SESSION['level'] = "siswa";
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;

                        $j = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE nis = '$username'"));
                        $_SESSION['jurusan'] = $j["id_jurusan"];
                        $_SESSION['tahun_ajaran'] = $j["tahun_ajaran"];

                        header("location:siswa/index.php");
                    }
                    else{
                        ?>
    <script>
        alert("LOGIN GAGAL\nUsername atau Password Salah");
        top.location = "login.php";
    </script>
    <?php
                    }

                }

                elseif($ruserperusahaan > 0) {

                        $userperusahaan  = mysql_query("SELECT * FROM hb_du_umum WHERE username='$username' AND password='$password' AND level='perusahaan' AND status='aktif' ");
                        $c  = mysql_fetch_array($userperusahaan);

                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = 'perusahaan';
                        $_SESSION['password'] = $password;
                        $_SESSION['id_du'] = $c["id_du"];
                        $_SESSION['tahun_ajaran'] = "2013-2014";

                        header("location:perusahaan/index.php");

                }
                elseif($rguru > 0) {

                    $c  = mysql_query("SELECT * FROM hb_login_operator WHERE nip_nis = '$username' and password='$password'");
                    $crow = mysql_fetch_row($c);

                    if ($crow>0) {
                        $_SESSION['level'] = "guru";
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;

                        $j = mysql_fetch_array(mysql_query("SELECT * FROM hb_guru_jurusan WHERE nip_guru = '$username'"));
                        $_SESSION['jurusan'] = $j["id_jurusan"];

                        header("location:guru/index.php");
                    }
                    else{
                        ?>
        <script>
            alert("LOGIN GAGAL\nUsername atau Password Salah");
            top.location = "login.php";
        </script>
        <?php
                    }

                }
                else{
                    ?>
            <script>
                alert("LOGIN GAGAL\nUsername atau Password Salah");
                top.location = "login.php";
            </script>
            <?php
                }

            break;

            case "logout";
                $_SESSION['level']= "";
                $_SESSION['username']="";
                $_SESSION['password']="";
                $_SESSION['nip'] = "";
                $_SESSION['tahun_ajaran'] ='';
                $_SESSION['nis'] ='';
                session_destroy();
                header('location:landing/index.php');
            break;


            case "register":
                $nama = anti_injection($_POST['nama']);
                $email = anti_injection($_POST['email']);
                $alamat = anti_injection($_POST['alamat']);
                $provinsi = anti_injection($_POST['prop']);
                $kabupaten = anti_injection($_POST['kota']);
                $kecamatan = anti_injection($_POST['kec']);
                $kelurahan = anti_injection($_POST['kel']);
                $kodepos = anti_injection($_POST['kodepos']);


                $a = mysql_query("SELECT email_du FROM hb_du_umum");
                $f = 0;

                    while($d=mysql_fetch_array($a)){
                      if($d['email_du']==$email){
                          $f=1;
                      }
                    }

                    if($f==0){
                        define('ROOT', 'http://hubin.smkn1-cmi.sch.id/bin/landing/');
                        $kode   = md5(uniqid(rand()));

                        $to     = $email;
                        $judul  = "Aktivasi Akun Anda";
                        $dari   = "From: http://hubin.smkn1-cmi.sch.id/\n";
                        $dari  .= "Content-type: text/html \r\n";

                        $pesan  = "Klik link berikut untuk mengaktifkan akun: <br />";
                        $pesan .= "<a href='".ROOT."verifikasiakun.php?kode=".$kode."'>Verifikasi Akun</a>";

                        $kirim  = mail($to, $judul, $pesan, $dari)or die(mysql_error());
                        if ($kirim) {
                            mysql_query("INSERT INTO hb_du_umum (id_kel, nama_du, email_du, alamat, id_prov, id_kab, id_kec, no_kodepos, level, status, kode)
                                VALUES('$kelurahan' ,'$nama','$email','$alamat','$provinsi', '$kabupaten', '$kecamatan',  '$kodepos', 'perusahaan', 'Belum Aktif', '$kode')")  or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());


                        ?>
                <script>
                    alert(" Register Berhasil! Cek Email untuk Verifikasi ");
                    top.location = 'landing/index.php';
                </script>
                <?php
                        }


                    }else{
                      ?>
                    <script>
                        alert('Gagal Dikirim ! Email Telah Digunakan');
                        top.location = 'landing/index.php';
                    </script>
                    <?php
                    }

              break;

              case "daftar-perusahaan":
                $username = anti_injection($_POST['username']);
                        $password = anti_injection($_POST['password']);
                        $password = md5($password);
                $nama = anti_injection($_POST['nama']);
                $email = anti_injection($_POST['email']);
                $bidang = anti_injection($_POST['bidang']);

                  $a = mysql_query("SELECT username FROM hb_user_admin");
                  $f = 0;

                    while($d=mysql_fetch_array($a)){
                      if($d['username']==$username){
                                $f=1;
                      }
                    }

                    if($f==0){
                        mysql_query("INSERT INTO hb_user_admin VALUES('$username','$password','perusahaan','aktif')");
                        mysql_query("INSERT INTO hb_du(username,nama_du,email,bidang) VALUES('$username','$nama','$email','$bidang')");
                    }else{
                      ?>
                        <script>
                            alert('Username Telah Digunakan');
                        </script>
                        <?php
                    }
              break;

        }
    }

?>