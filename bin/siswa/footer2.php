
        <!--footer section start-->
        <footer class="sticky-footer">
            2015 &copy; Hubin by DeaEmalia
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="bin/js/jquery-1.10.2.js"></script>
<script src="bin/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="bin/js/jquery-migrate-1.2.1.min.js"></script>
<script src="bin/js/bootstrap.min.js"></script>
<script src="bin/js/modernizr.min.js"></script>
<script src="bin/js/jquery.nicescroll.js"></script>

<script src="bin/js/jquery-ui_auto_complete.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="bin/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="bin/js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization -->
<script src="bin/js/dynamic_table_init.js"></script>

<!--common scripts for all pages-->
<script src="bin/js/scripts.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="bin/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="bin/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="bin/js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="bin/js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="bin/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="bin/js/bootstrap-timepicker.js"></script>

<!--pickers initialization-->
<script src="bin/js/pickers-init.js"></script>

<!--icheck -->
<script src="bin/js/iCheck/jquery.icheck.js"></script>
<script src="bin/js/icheck-init.js"></script>

<script type="text/javascript" src="bin/js/ajax_daerah.js"></script>

<script>
  $(function() {
    $( "#siswa" ).autocomplete({
      source: '../autocomplete/siswa_perjurusan.php'
    });
  });
</script>
<script>



</script>
 <script type="text/javascript">
$(document).ready(function() {
    $(".prop2").change(function(){
        var id = $(this).val();
        $.get('select_daerah.php',{prop : id},function(data){
            $(".kota2").empty();
            $(".kota2").html(data);
        });
    });

    $(".kota2").change(function(){
        var id = $(this).val();
        $.get('select_daerah.php',{kab : id},function(data){
            $(".kec2").empty();
            $(".kec2").html(data);
        });
    });

    $(".kec2").change(function(){
        var id = $(this).val();
        $.get('select_daerah.php',{kec : id},function(data){
            $(".kel2").empty();
            $(".kel2").html(data);
        });
    });

    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append("<div class='form-inline'><br><div><?php echo "<select class='form-control m-bot15' name='jurusan[]'> <option value=''> * Pilih Jurusan * </option>";  $jurusan = mysql_query("SELECT * FROM jurusan"); while($j = mysql_fetch_array($jurusan)){ echo " <option value='$j[id_jurusan]'> $j[nama_jurusan] </option>"; } echo " </select>"; ?> <input type='text' class='form-control' name='jumlah[]' placeholder='Jumlah'> <a href='#' class='remove_field'><button style='margin-top: -69px; margin-left: 218px; 'class='btn btn-xs btn-danger add_field_button'><i class='fa fa-times-circle'></i></button></a></div></div>"); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
  </script>

      <script>

    $('#detail').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget); // Button that triggered the modal
      var recipient = button.data('id'); // Extract info from data-* attributes
      var modal = $(this);
        $.ajax({
            type: 'POST',
            url: 'detailpekerjaan.php',
            data: 'id='+recipient,
            dataType: 'json',
            success: function(result) {
                modal.find("#id").val(recipient);
                modal.find("#namadu").text(result['nama_du']);
            }
        })
     

    });

    

    </script>

<script>

    $('#apply').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal

        var recipient = button.data('id'); // Extract info from data-* attributes

      

        var modal = $(this);

        modal.find("#id").val(recipient);


    });

    </script>
    <script>
$('#lampiran').bind('change', function() {

  //this.files[0].size gets the size of your file.
  if(this.files[0].size>5000000){
        alert("File harus kurang dari 5Mb !");
        $('#lampiran').val("");
    }
});


</script>


    <script>
        function ajax(){
        
        var req = new XMLHttpRequest();
        
        req.onreadystatechange = function(){
        
        if(req.readyState == 4 && req.status == 200){
        
        document.getElementById('chat').innerHTML = req.responseText;
        } 
        }
        req.open('GET','bin/siswa/chat.php',true); 
        req.send();

        }
        
        function ajax2(){
        var req = new XMLHttpRequest();
        
        req.onreadystatechange = function(){
        
        if(req.readyState == 4 && req.status == 200){
        
        document.getElementById('chat').innerHTML = req.responseText;
        } 
        }
        req.open('GET','bin/siswa/chat.php',true); 
        req.send();
        scrolling();
        }
        function scrolling(){

            $('#cb').animate({
            scrollTop: $('#cb').get(0).scrollHeight}, 10);

        }
        setInterval(function(){ajax()},1000);
        
    </script>
  <link href="../css/admin.css" rel="stylesheet">
</body>
</html>
