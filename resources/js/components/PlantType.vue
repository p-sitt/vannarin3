<template>
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-seedling fa-2x green"></i>
                    ตารางประเภทของของพืช</h3>
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
                      <th>ชื่อประเภท</th>
                      <th>แก้ไข</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="planttype in planttypes" :key="planttype.id" >
                        <td>{{ $number++ }}</td>
                        <td>{{planttype.id}}</td>
                        <td>{{planttype.name}}</td>
                        <td> 
                          <a href="#" class="btn btn-primary" @click="editModal(planttype)">
                              <i class="fas fa-edit"></i>
                          </a>
                          /
                          <a href="#" class="btn btn-danger" @click="deleteType(planttype.id)">
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
        <form @submit.prevent="editmode ? updateType() : createType()">
        <div class="modal-dialog modal-dialog-centered" role="document">
            
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">
                            <i class="fas fa-seedling fa-fw"></i>แก้ไขข้อมูลชนิดพืช</h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">
                            <i class="fas fa-seedling fa-fw"></i> เพิ่มชนิดพืช</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input v-model="form.name" type="text" name="name" placeholder="ชื่อ"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
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
                planttypes : {},
                form: new Form({
                     id:'',
                     name: ''
                 })    
            }
        },
        methods:{
          updateType(){
                this.$Progress.start();
                this.form.put('api/planttype/'+this.form.id)
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
                    Swal.fire('ไม่สำเร็จ!','คุณไม่มีสิทธิแก้ไขข้อมูลผู้ใช้','warning');
                });
            },
          createType(){
                this.$Progress.start();
                this.form.post('api/planttype')
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
            deleteType(id){
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
                        this.form.delete('api/planttype/'+id).then(()=>{
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
          loadTypes(){
              axios.get('api/planttype').then(({ data }) =>(this.planttypes = data));  
          },
          editModal(planttypes){
              this.editmode = true;
              this.form.reset();
              $('#addNew').modal('show');
              this.form.fill(planttypes);
          },
          newModal(){
              this.editmode = false;
              this.form.reset();
              $('#addNew').modal('show');
          },
        },
        created() {
            this.loadTypes();
            Fire.$on('AfterCreate',() => {
                this.loadTypes();
            });
          },
    }
</script>
