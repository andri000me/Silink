<script type="text/javascript">
	$(document).ready(function(){

        daftar_keuangan();
        info_debit_credit();

        function daftar_keuangan(query){
            $.ajax({
                url   : '<?= base_url("admin/keuangan/daftar_keuangan")?>',
                method:"POST",
                data:{query:query},
                success : function(data){
                    $('#show_data_keuangan').html(data);
                }
 
            });
        }

        function info_debit_credit(){
            $.ajax({
                url   : '<?= base_url("admin/keuangan/info_debit_credit")?>',
                method:"POST",
                dataType:'json',
                success : function(data){
                	$.each(data,function(total_debit, total_credit, total_keuangan, persendebit, persencredit){
	                    $('#infodebit').html('Rp. '+data.total_debit);
	                    $('#infocredit').html('Rp. '+data.total_credit);
	                    $('#persencredit').html(data.persencredit+'%');
	                    $('#persendebit').html(data.persendebit+'%');
	                    $('#totalkeuangan').html('Rp. '+data.total_keuangan);
	                });
 				}
            });
        }

        //  -----------------------------------------------------------------------------
        //  |       PENCARIAN DATA                                                      |
        //  -----------------------------------------------------------------------------

        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '') {
                daftar_keuangan(search);
            } else {
                daftar_keuangan();
            }
        });

        //  -----------------------------------------------------------------------------
        //  |       MENAMPILKAN DATA DI FORM TAMBAH DATA                                |
        //  -----------------------------------------------------------------------------
        
        $('#btn_tambah_data').on('click', function(){
            $('#add_modal_keuangan').modal('show');
            $.ajax({
            	url: '<?= base_url('admin/keuangan/get_id') ?>',
            	type: 'POST',
            	dataType: 'json',
            	success:function(no) {
            		$('[name="no_keuangan"]').val(no);
            	}
            });
            
        });

        $('#btn_submit_keuangan').on('click', function () {
        	var no_keuangan = $('[name="no_keuangan"]').val();
        	var nilai_keuangan = $('[name="nilai_keuangan"]').val();
        	var jenis_keuangan = $('[name="jenis_keuangan"]').val();
        	var catatan = $('[name="catatan"]').val();

        	$.ajax({
        		url: '<?= base_url('admin/keuangan/save_keuangan') ?>',
        		type: 'POST',
        		dataType: 'JSON',
        		data: {no_keuangan:no_keuangan, nilai_keuangan:nilai_keuangan, jenis_keuangan:jenis_keuangan, catatan:catatan},
        		success: function(data) {
        			$("#alert-success-text").html('Data Berhasil di Simpan');
                    $("#alert-success").fadeIn().delay(1000).fadeOut();
                    $('#add_modal_keuangan').modal('hide');
                    $('[name="no_keuangan"]').val('');
		        	$('[name="nilai_keuangan"]').val('');
		        	$('[name="jenis_keuangan"]').val('');
		        	$('[name="catatan"]').val('');
                    daftar_keuangan();
                    info_debit_credit();
        		}
        	});
        });


    });
</script>

</body>
</html>