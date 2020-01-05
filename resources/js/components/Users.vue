<template>
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">ตารางผู้ใช้งาน</h3>

                <div class="card-tools">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addNew"> 
                        <i class="fas fa-user-plus fa-fw"></i> 
                        เพิ่มผู้ใช้ 
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
                      <th>ชื่อ</th>
                      <th>อีเมล์</th>
                      <th>ประเภท</th>
                      <th>ลงทะเบียน</th>
                      <th>แก้ไข</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key="user.id" >
                        <td>{{ $number++ }}</td>
                        <td>{{user.id}}</td>
                        <td>{{user.name | upText}}</td>
                        <td>{{user.email}}</td>
                        <td>
                            <div v-if="user.type == 0">
                                ผูู้ใช้
                            </div>
                            <div v-else>
                                ผู้ดูแลระบบ
                            </div>
                        </td>
                        <td>{{user.created_at | myDate}}</td>
                        <td> 
                          <a href="#" class="btn btn-primary">
                              <i class="fas fa-edit"></i>
                              แก้ไข
                          </a>
                          /
                          <a href="#" class="btn btn-danger" @click="deleteUser(user.id)">
                              <i class="fas fa-trash"></i>
                              ลบ
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
            <form @submit.prevent="createUser">
        <div class="modal-dialog modal-dialog-centered" role="document">
            
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="addNewLabel"><i class="fas fa-user-plus fa-fw"></i> เพิ่มผู้ใช้ใหม่</h5>
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
                        <div class="form-group">
                            <select v-model="form.type" type="text" name="type" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                <option value="">ประเภทผูู้ใช้</option>
                                <option value="0">ผูู้ใช้</option>
                                <option value="1">ผู้ดูแลระบบ</option>
                            </select>
                            <has-error :form="form" field="type"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.email" type="text" name="email" placeholder="อีเมล์"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.password" type="password" name="password" placeholder="กำหนดรหัสผ่าน"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
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
                users : {},
                 form: new Form({
                     name: '',
                     type: '',
                     email: '',
                     password: ''
                 })    
            }
        },
        methods:{
            deleteUser(id){
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
                        this.form.delete('api/user/'+id).then(()=>{
                            if (result.value) {
                                Swal.fire(
                                'ลบข้อมูลเรียบร้อย!',
                                'ข้อมูลถูกลบแล้ว.',
                                'success'
                                )
                                Fire.$emit('AfterCreate');
                            }
                        }).catch(()=>{
                            swal('Failed!','There was somthing wrong.','warning');
                        });
                    }
                })
            },
            loadUsers(){
              axios.get('api/user').then(({ data }) =>(this.users = data.data));  
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
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

                });
            }
        },
        created() {
            this.loadUsers();
            Fire.$on('AfterCreate',() => {
                this.loadUsers();
            });
            //setInterval(() =>this.loadUsers(),3000);
        }
    }
</script>
