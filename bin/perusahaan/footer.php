
        <!--footer section start-->
        <footer class="sticky-footer">
            2015 &copy; Hubin by DeaEmalia
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/modernizr.min.js"></script>
<script src="../js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="../js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../js/data-tables/DT_bootstrap.js"></script>

<!--dynamic table initialization -->
<script src="../js/dynamic_table_init.js"></script>

<!--common scripts for all pages-->
<script src="../js/scripts.js"></script>

<!--icheck -->
<script src="../js/iCheck/jquery.icheck.js"></script>
<script src="../js/icheck-init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-timepicker.js"></script>

<!--pickers initialization-->
<script src="../js/pickers-init.js"></script>



<script type="text/javascript" src="../js/ajax_daerah.js"></script>

 <script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append("<div class='form-inline' style='width:800px;;float:left'><br><div><?php echo "<select required class='form-control m-bot15 sk' name='jurusan[]' id='jur[]' style='float:left'> <option value=''> * Pilih Jurusan * </option>";  $jurusan = mysql_query("SELECT * FROM jurusan"); while($j = mysql_fetch_array($jurusan)){ echo " <option value='$j[id_jurusan]'> $j[nama_jurusan] </option>"; } echo " </select>"; ?> <input type='number' class='form-control' style='width:80px;float:left' name='jumlah[]' id='jl[]' placeholder='Jumlah' required> <a href='#' class='remove_field'><button style=' margin-left:10px; 'class='btn btn-xs btn-danger add_field_button'><i class='fa fa-times-circle'></i></button></a></div></div></div><div class='col-md-12' style='padding:0'><div class='col-md-10' style='padding:0 10px 0 0'><input type='text' name='skill[]' placeholder='Web,Teknisi,Android' class='form-control'></div><div class='col-md-12' style='padding:0'><small style='color: #D9534F'>Pisahkan Skill dengan Koma</small></div></div>"); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
  </script>
    <script>

    $('#detaillamar').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget); // Button that triggered the modal
      var recipient = button.data('id'); // Extract info from data-* attributes
      var modal = $(this);
        $.ajax({
            type: 'POST',
            url: 'detlamar.php',
            data: 'id='+recipient,
            dataType: 'json',
            success: function(result) {
                modal.find("#id").val(recipient);
                var add = '../images/uploads/'+result["foto"];
                modal.find("#poto").attr('src',add);
                modal.find("#namasiswa").text(result['nama_siswa']);
                modal.find("#jur").text(result['nama_jurusan']);
                modal.find("#ttl").text(result['tempat_lahir']);
                modal.find("#tgl").text(result['tanggal_lahir']);
                modal.find("#agama").text(result['agama']);
                modal.find("#goldar").text(result['gol_darah']);
                modal.find("#porto").text(result['portofolio']);
                modal.find("#jk").text(result['jenis_kelamin']);
                modal.find("#email").text(result['email_siswa']);
                modal.find("#notelp").text(result['no_telepon']);
                if(result['lampiran']!=""){
                    modal.find("#lam").attr("href", "../siswa/"+result['lampiran']);
                }else{

                modal.find("#lam").text("");
                modal.find("#text").text("");
                }
            }
        })
     

    });

    

    </script>
    <script>

    $('#terima').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal

        var recipient = button.data('id'); // Extract info from data-* attributes

        var recipient2 = button.data('nama'); // Extract info from data-* attributes

        var modal = $(this);

        modal.find("#id").val(recipient);
        modal.find("#namasiswa").text(recipient2);

    });

    </script>
    <script>

    $('#tolak').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal

        var recipient = button.data('id'); // Extract info from data-* attributes

      

        var modal = $(this);

        modal.find("#id").val(recipient);
        var recipient2 = button.data('nama');
        modal.find("#namasiswa").text(recipient2);
    });

    $( "#sel" ).change(function() {
    if(this.value=="Ya"){
        $("#selek").css("display","block");
    }else{
        $("#selek").css("display","none");
    }
});

$('select.sk').live('change', function() {
    var index = $('select').index(this);
    if(this.value==1){
        
    }else if(this.value==2){
        
    }
});

$("#plus1").click(function(){
    $("#p2").append("<div class='form-inline' style='width:800px;;float:left'><br><div><?php echo "<select required class='form-control m-bot15' name='jurusan[]' style='float:left'> <option value=''> * Pilih Jurusan * </option>";  $jurusan = mysql_query("SELECT * FROM jurusan"); while($j = mysql_fetch_array($jurusan)){ echo " <option value='$j[id_jurusan]'> $j[nama_jurusan] </option>"; } echo " </select>"; ?> <input type='number' class='form-control' style='width:80px;float:left' name='jumlah[]' placeholder='Jumlah' required></div></div>");
});
    </script>
  <link href="../css/admin.css" rel="stylesheet">
</body>
</html>
