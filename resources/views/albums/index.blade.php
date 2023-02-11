@extends('layouts.app')

@section('content')

<h1> Albums </h1>
<div class="row">
  <div>
    <canvas id="myChart"></canvas>
  </div>
</div>
<div class="row">
    <table class="table" id="table_id">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">description</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
</div>

@endsection
@push('javascript')
    <script>
      $(function () {
        var table =$('#table_id').DataTable({
          processing:true,
          serverSide:true,
          order:[
            [0,"desc"]
          ],
          ajax:"{{Route('albums.all')}}",
          columns: [{
            data:'id',
            name:'id'
          },
          {
            data:'name',
            name:'name'
          },
          {
            data:'description',
            name:'description'
          },
          {
            data:'action',
            name:'action'
          }
          ]
        })
      })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
      const ctx = document.getElementById('myChart');
    
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: {!!json_encode($label)!!},
          datasets: [{
            label: '# of number',
            data: {!!json_encode($photoCount)!!},
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
@endpush