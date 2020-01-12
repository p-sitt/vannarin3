<template>
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-seedling fa-2x green"></i>
                    &nbsp  ตารางพืช</h3>
                <div class="card-tools">
                    <button class="btn btn-success"> 
                        <i class="fas fa-user-plus fa-fw"></i> 
                        เพิ่มประเภทพืช
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                  <div style="visibility: hidden;">{{ $number = 1 }}</div>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ลำดับ</th>
                      <th>ไอดี</th>
                      <th>ชื่อประเภท</th>
                      <th>แก้ไข</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="plant in plants" :key="plant.id" >
                        <td>{{ $number++ }}</td>
                        <td>{{plant.id}}</td>
                        <td>{{plant.name | upText}}</td>
                        <td> 
                          <a href="#" class="btn btn-primary">
                              <i class="fas fa-edit"></i>
                          </a>
                          /
                          <a href="#" class="btn btn-danger">
                              <i class="fas fa-trash"></i>
                          </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </section>
</template>

<script>
    export default {
        data(){
            return{
                editmode: false,
                plants : {},
                 form: new Form({
                    type: '',
                    name:'', 
                    family_name: '', 
                    other_name: '',
                    sci_name: '',
                    suitable_range: '',
                    water_level: '',
                    height: '',
                    root_range: '',
                    img_trunk: '',
                    img_blade: '',
                    img_flower: '',
                    img_fruit: '',
                    product_start: '',
                    product_range: '',
                    age: '',
                    comment: ''
                 })    
            }
        },
        methods:{
            loadPlants(){
              axios.get('api/plant').then(({ data }) =>(this.plants = data.data));  
            }
        },
        mounted() {
            loadPlants();
        }
    }
</script>
