<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hasil Perangkingan</title>
    <link rel="shortcut icon" href="{{ url('backend/images/logo.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<style>
		table, th, td {
			border: 1px solid black !important;
			border-collapse: collapse;
		}
	</style>
</head>
<body>
    <h4 class="text-center font-weight-bold" style="font-size: 18px;">Hasil Perangkingan Periode {{ $periode_pilihan->nama_periode }}</h4>
	<center>
		<table class="table table-bordered mt-3" style="width: 600px">
			<thead>
				<tr class="text-center">
					<th style="width: 5%">Ranking</th>
					<th>Nama</th>
					<th>Nilai</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($items as $data)
				<tr>
					<td class="text-center">{{ $data->rank }}</td>
					<td>{{ $data->guru->nama }}</td>
					<td>{{ $data->ki }}</td>
				</tr>
				@empty
					<tr>
						<th colspan="4">-- Data Kosong --</th>
					</tr>
				@endforelse
			</tbody>
		</table>
	</center>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script>
    window.print();
</script>
</html>
