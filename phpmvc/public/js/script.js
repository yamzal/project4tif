$(function() {
	//mendapatkan attribut tombol tambah data pada kelas kemudian dikenakan function
	$('.tombolTambahData').on('click', function() {
		$('#formModalLabel').html('Tambah Data Mahasiswa');
		$('.modal-footer button[type=submit]').html('Tambah Data');
		
		$('#nama').val('');
        $('#nim').val('');
        $('#email').val('');
        $('#jurusan').val('');
        $('#id').val('');
	});
	
	$('.tampilModalUbah').on('click', function() {

		$('#formModalLabel').html('Ubah Data Mahasiswa');
		$('.modal-footer button[type=submit]').html('Ubah Data');
		$('.modal-body form').attr('action','http://localhost/phpmvc/public/mahasiswa/ubah');   
		
		//mendapatkan data id 
		const id = $(this).data('id');
	
		//menjalankan ajax
		//ambil data dari url
		$.ajax({			
			url: 'http://localhost/phpmvc/public/mahasiswa/getubah',
			data: {id : id},
			method: 'post',
			dataType: 'json', 			
			success: function(data) {	
//				console.log(data);
				$('#nama').val(data.nama);
				$('#nim').val(data.nim);
				$('#email').val(data.email);
				$('#jurusan').val(data.jurusan);
				$('#id').val(data.id);				
			}
			
		}); 
		
	});

});
