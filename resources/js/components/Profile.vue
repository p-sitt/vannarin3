<style>
    .widget-user-header{
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .widget-user .widget-user-header{
        height: 250px;
    }
    .btn-file {
    position: relative;
    overflow: hidden;
  }

</style>

<template>
    <section class="content">
            <div class="col-md-12 ">
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url('./img/dragonfly-2551460.jpg')">
                <h3 class="widget-user-username text-left">{{this.form.name}}</h3>
                <h5 class="widget-user-desc text-left">{{this.form.type}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" id="profile-img" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>

           
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">ข้อมูลผู้ใช้งาน</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">แก้ไขข้อมูล</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                     <h4>ชื่อ : {{this.form.name}}</h4>
                     <h4>อีเมล์ : {{this.form.email}}</h4>
                     <h4>ประเภทผู้ใช้ : {{this.form.type}}</h4>
                     <h4>ที่อยู่ : {{this.form.address}}</h4>
                     <h4>รหัสไปรษณีย์ : {{this.form.zipcode}}</h4>
                     <h4>ที่ตั้ง : {{this.form.location}}</h4>
                     <h4>พื้นที่ : {{this.form.area}}</h4>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="control-label">ชื่อ</label>
                            <input type="text" v-model="form.name" id="name" name="name" placeholder="ชื่อ" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">อีเมล์</label>
                            <input type="text" v-model="form.email" id="email" name="email" placeholder="อีเมล์" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">รหัสผ่าน (ปล่อยว่างถ้าไม่ต้องการเปลี่ยน)</label>
                            <input type="password"
                                v-model="form.password"
                                class="form-control"
                                id="password"
                                placeholder="รหัสผ่าน"
                                :class="{ 'is-invalid': form.errors.has('password') }"
                            >
                              <has-error :form="form" field="password"></has-error>
                        </div>
                        <div class="form-group">
                        <label for="address" class="control-label">ที่อยู่</label>
                        <textarea class="form-control" v-model="form.address" rows="2" id="address" name="address" placeholder="ที่อยู่ ..."></textarea>
                      </div>
                      <div class="form-group">
                            <label for="zipcode" class="control-label">รหัสไปรษณีย์</label>
                            <input type="text" v-model="form.zipcode" id="zipcode" name="zipcode" placeholder="รหัสไปรษณีย์" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="location" class="control-label">ที่ตั้ง</label>
                            <input type="text" v-model="form.location" id="location" name="location" placeholder="ที่ตั้ง" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="area" class="control-label">พื้นที่</label>
                            <input type="text" v-model="form.area" id="area" name="area" placeholder="พื้นที่" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="photo" class="control-label">ภาพโปรไฟล์</label>
                          <div class="col-sm-12">
                              <input type="file" @change="updateProfile" name="photo"  class="form-input">
                          </div>

                      </div>
                      <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-12">
                          <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                          </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->

            </div>
            <!-- /.nav-tabs-custom -->
        


            </div>
        
    </section>
</template>

<script>
    export default {
        data(){
            return{
              form: new Form({
                     id:'',
                     name: '',
                     email: '',
                     password: '',
                     type: '',
                     address:'',
                     zipcode:'',
                     location:'',
                     area:'',
                     photo:''
                 })    
            }
        },
        methods:{
          getProfilePhoto(){
                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;  
                return photo;
            },
            updateInfo(){
              this.$Progress.start();
                this.form.put('api/profile/')
                .then(()=>{

                    this.$Progress.finish();
                })
                .catch(()=>{
                   this.$Progress.fail();
                });
            },
            updateProfile(e){
                //console.log('Uploading')
                let file = e.target.files[0];
                console.log(file);

                let reader = new FileReader();
                
                if(file['size'] < 2111775){

                  reader.onloadend =(file) =>{
                    
                    this.form.photo = reader.result;

                  }
                }else{

                   Swal.fire({
                      type: 'error',
                      icon: 'warning',
                      title: 'Oops',
                      text: 'ไฟล์ภาพมีขนาดใหญ่เกินไป ขนาดภาพไม่ควรเกิน 2 MB',
                    })
                }
                reader.readAsDataURL(file);
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        
        created(){
          axios.get('api/profile').then(({ data }) => (this.form.fill(data)));  
        }
    }
</script>
