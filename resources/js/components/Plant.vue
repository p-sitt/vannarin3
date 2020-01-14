<template>
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-seedling fa-2x green"></i>
                    ตารางพืช</h3>
                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal"> 
                        <i class="fas fa-seedling fa-fw"></i> 
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
                      <th>ชื่อสามัญ</th>
                      <th>ชื่ออื่น</th>
                      <th>แก้ไข</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="plant in plants" :key="plant.id" >
                        <td>{{ $number++ }}</td>
                        <td>{{plant.id}}</td>
                        <td>{{plant.name}}</td>
                        <td>{{plant.other_name}}</td>
                        <td> 
                          <a href="#" class="btn btn-primary" @click="editModal(plant)">
                              <i class="fas fa-edit"></i>
                          </a>
                          /
                          <a href="#" class="btn btn-danger" @click="deletePlant(plant.id)">
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
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <form @submit.prevent="editmode ? updatePlant() : createPlant()">
        <div class="modal-dialog modal-dialog-centered" role="document">
            
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">
                            <i class="fas fa-seedling fa-fw"></i>แก้ไขข้อมูลพืช</h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">
                            <i class="fas fa-seedling fa-fw"></i> เพิ่มพืช</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                            <select v-model="form.type" type="text" name="type" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('type') }" >
                                <option value="">เลือกชนิด</option>
                                <option v-for="planttype in planttypes" v-bind:value="planttype.name">{{planttype.name}}</option>
                            </select>
                            <has-error :form="form" field="type"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.name" type="text" name="name" placeholder="ชื่อ"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.family_name" type="text" name="family_name" placeholder="ชื่อวงศ์"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('family_name') }">
                            <has-error :form="form" field="family_name"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.other_name" type="text" name="other_name" placeholder="ชื่ออื่น"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('other_name') }">
                            <has-error :form="form" field="other_name"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.sci_name" type="text" name="sci_name" placeholder="ชื่อวิทยาศาสตร์"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('sci_name') }">
                            <has-error :form="form" field="sci_name"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.suitable_range" type="text" name="suitable_range" placeholder="ช่วงเวลาที่เหมาะสม"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('suitable_range') }">
                            <has-error :form="form" field="suitable_range"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.water_level" type="text" name="water_level" placeholder="ระดับน้ำ"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('water_level') }">
                            <has-error :form="form" field="water_level"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.height" type="text" name="height" placeholder="ความสูง"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('height') }">
                            <has-error :form="form" field="height"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.root_range" type="text" name="root_range" placeholder="ความยาวราก"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('root_range') }">
                            <has-error :form="form" field="root_range"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.age" type="text" name="age" placeholder="ช่วงอายุ"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('age') }">
                            <has-error :form="form" field="age"></has-error>
                        </div>
                        <div class="form-group">
                          <textarea class="form-control" :class="{ 'is-invalid': form.errors.has('comment') }" v-model="form.comment" rows="2" id="comment" name="comment" placeholder="รายละเอียด ..."></textarea>
                            <has-error :form="form" field="comment"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" v-show="editmode" class="btn btn-primary">แก้ไขข้อมูล</button>
                        <button type="submit" v-show="!editmode" class="btn btn-success">เพิ่มข้อมูล</button>
                    </div>
                </div>
        </div>
        </form>
        </div>
    </section>
</template>

<script>
    export default {
        data(){
            return{
                editmode: false,
                plants : {},
                planttypes : {} ,
                form: new Form({
                    id:'',
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
          updatePlant(){
                this.$Progress.start();
                this.form.put('api/plant/'+this.form.id)
                .then(() => {
                    $('#addNew').modal('hide');
                    Swal.fire(
                                'แก้ไขข้อมูลเรียบร้อย!',
                                'ข้อมูลถูกแก้ไขแล้ว.',
                                'success'
                                )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                    
                })
                .catch(() => {
                    this.$Progress.fail();
                    $('#addNew').modal('hide');
                    //Swal.fire('ไม่สำเร็จ!','คุณไม่มีสิทธิแก้ไขข้อมูลผู้ใช้','warning');
                });
            },
          createPlant(){
                this.$Progress.start();
                this.form.post('api/plant')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'เพิ่มข้อมูลเรียบร้อย'
                    })
                    this.$Progress.finish();
                })
                .catch(()=>{
                    this.$Progress.fail();
                });
            },
            deletePlant(id){
                Swal.fire({
                title: 'ยืนยันการลบข้อมูล?',
                text: "คุณจะไม่สามารถกู้คืนข้อมูลได้อีก!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบข้อมูล!',
                cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                //send request to the server
                    if(result.value){
                        this.form.delete('api/plant/'+id).then(()=>{
                            if (result.value) {
                                Swal.fire(
                                'ลบข้อมูลเรียบร้อย!',
                                'ข้อมูลถูกลบแล้ว.',
                                'success'
                                )
                                Fire.$emit('AfterCreate');
                            }
                        }).catch(()=>{
                             //Swal.fire('ไม่สำเร็จ!','คุณไม่มีสิทธิลบข้อมูลผู้ใช้','warning');
                        });
                    }
                })
            },
            loadPlants(){
              axios.get('api/plant').then(({ data }) =>(this.plants = data));
              axios.get('api/planttype').then(({ data }) =>(this.planttypes = data));
              
            },
            editModal(plant){
              this.editmode = true;
              this.form.reset();
              $('#addNew').modal('show');
              this.form.fill(plant);
          },
            newModal(){
              this.editmode = false;
              this.form.reset();
              $('#addNew').modal('show');
          },
        },
        created() {
            this.loadPlants();
            Fire.$on('AfterCreate',() => {
                this.loadPlants();
            });
          }
    }
</script>
