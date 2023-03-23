<!DOCTYPE html>
<html>
  <head>
    <title>Google Drive Casero :)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script>
      function submitForm() {
        var info = document.getElementById("info").value;
        var result = info.replaceAll("/", "+");
        result = result.substring(1);

        window.location.href = "/" + result;
      }

    </script>

    <script>
        function gotoDir($dir) {
        window.location.href += "+" + $dir;
      }

      function gotoPreviousDir() {
        url = window.location.href;
        const lastPlusIndex = url.lastIndexOf('+');

// Obtener la subcadena que comienza desde el inicio hasta la posición del último '+'
const result = url.substring(0, lastPlusIndex);

    window.location.href = result;

      }
    </script>

  </head>
  <body> 
    @php 
    session(['url' => $path]); 
    @endphp 
    <div class="container mt-4">
      <div class="card">
        <div class="card-header text-center font-weight-bold"> Google Drive Casero :) </div>
        <div class="card-body"> 
            @csrf 
            <div class="form-group">
            <label for="exampleInputEmail1">Ruta</label>
            <input type="text" id="info" class="form-control" required="" value="{{ $path }}">
          </div>
          <div class="flex justify-end pt-2">
            <!-- <button type="submit" class=" btn-primary text-white bg-indigo-600
                        hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300
                        font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save
                        Profile</button> -->
            <button type="button" value="Submit" onclick="submitForm()" class=" btn-primary text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Jump</button>
          </div>
          <form method="post" action="" enctype="multipart/form-data"> @csrf <div class="mb-6">
              <label for="archivo" class="block mb-2 text-sm font-medium">Archivo</label>
              <input type="file" name="archivo" id="archivo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 form-control">
            </div>
            <div class="flex justify-end pt-2">
              <button type="submit" class=" btn-primary text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save Profile</button>
            </div>
          </form>
          <div class="container mt-4">

            <div class="row">
            <div class="col-md-4">
                <div class="card bg-info">
                  <div class="card-body">
                    <h5 class="card-title">..</h5>
                        <input type="hidden" name="directory">
                      <input type="hidden" name="path" value="{{ $path }}">
                      <button class="btn btn-primary btn-sm rounded-0" onclick="gotoPreviousDir()" type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                        <i class="fa-solid fa-backward"></i>
                      </button>
                  </div>
                </div>
              </div> 
                @foreach($directories as $directory) 
                <div class="col-md-4">
                <div class="card bg-info">
                  <div class="card-body">
                    <h5 class="card-title">{{ $directory }}</h5>
                        <input type="hidden" name="directory" value="{{ $directory }}">
                      <input type="hidden" name="path" value="{{ $path }}">
                      <button class="btn btn-primary btn-sm rounded-0" onclick="gotoDir('{{ $directory }}')" type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                        <i class="fa-solid fa-forward"></i>
                      </button>
                  </div>
                </div>
              </div>
            @endforeach 
            @foreach($files as $file) 
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">{{ $file }}</h5>
                    <div style="display: flex;">
                      <form method="post" action="{{ url('deletefiles/a')  }}" class="form-inline mr-2"> @csrf <input type="hidden" name="file" value="{{ $file }}">
                        <input type="hidden" name="path" value="{{ $path }}">
                        <button class="btn btn-danger btn-sm rounded-0 d-inline-block" type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
                      <form method="post" action="{{ url('downloadfiles/a')  }}" class="form-inline"> @csrf <input type="hidden" name="file" value="{{ $file }}">
                        <input type="hidden" name="path" value="{{ $path }}">
                        <button class="btn btn-success btn-sm rounded-0 d-inline-block" type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download">
                          <i class="fa fa-download"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div> 
              @endforeach 
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>