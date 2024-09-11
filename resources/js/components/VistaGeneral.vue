<template>
  <div class="container mt-4">
    <div class="card">
      <div class="card-header text-center font-weight-bold">Google Drive Casero :)</div>
      <div class="card-body">
        <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
          <div class="mb-6">
            <label for="archivo" class="block mb-2 text-sm font-medium">Archivo</label>
            <input
              type="file"
              name="archivo"
              id="archivo"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 form-control"
              @change="handleFileChange"
            />
          </div>
          <div class="flex justify-end pt-2">
            <button
              type="submit"
              class="btn-primary text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
            >
              Save Profile
            </button>
          </div>
        </form>

        <div class="container mt-4">
          <div class="row">
            <div class="col-md-4">
              <div class="card bg-info">
                <div class="card-body">
                  <h5 class="card-title">..</h5>
                  <button
                    class="btn btn-primary btn-sm rounded-0"
                    @click="gotoPreviousDir"
                    title="Previous Directory"
                  >
                    <i class="fa-solid fa-backward"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Directories -->
            <div class="col-md-4" v-for="(directory, index) in directories" :key="'dir-' + index">
              <div class="card bg-info">
                <div class="card-body">
                  <h5 class="card-title">{{ directory }}</h5>
                  <button
                    class="btn btn-primary btn-sm rounded-0"
                    @click="gotoDir(directory)"
                    title="Go to Directory"
                  >
                    <i class="fa-solid fa-forward"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Files -->
            <div class="col-md-4" v-for="(file, index) in files" :key="'file-' + index">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ file }}</h5>
                  <div style="display: flex;">
                    <form @submit.prevent="deleteFile(file)">
                      <input type="hidden" name="file" :value="file" />
                      <button class="btn btn-danger btn-sm rounded-0 d-inline-block" type="submit" title="Delete">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                    <form @submit.prevent="downloadFile(file)">
                      <input type="hidden" name="file" :value="file" />
                      <button class="btn btn-success btn-sm rounded-0 d-inline-block" type="submit" title="Download">
                        <i class="fa fa-download"></i>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      files: [],
      directories: [],
      loading: true,
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    async getData() {
      try {
        // Realizar la petición GET a tu API
        const response = await axios.get('/api');

        // Asignar los datos obtenidos a los arrays de archivos y directorios
        this.files = response.data.files;
        this.directories = response.data.directories;
      } catch (error) {
        console.error('Error al obtener los datos:', error);
      } finally {
        this.loading = false;
      }
    },
    gotoDir(dir) {
      // Actualiza la URL al hacer clic en un directorio
      window.location.href += "+" + dir;
    },
    gotoPreviousDir() {
      // Modifica la URL para volver al directorio anterior
      const url = window.location.href;
      const lastPlusIndex = url.lastIndexOf('+');
      // Obtener la subcadena que comienza desde el inicio hasta la posición del último '+'
      const result = url.substring(0, lastPlusIndex);
      window.location.href = result;
    },
  },
};
</script>

<style scoped>
/* Add any additional styles here */
</style>
