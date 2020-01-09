<style>
    .widget-user-header{
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .widget-user .widget-user-header{
        height: 250px;
    }
    #img-upload{
      max-height: 200px;
      float: left;
    }
    .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>

<template>
    <section class="content">
            <div class="col-md-12 ">
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url('./img/dragonfly-2551460.jpg')">
                <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
                <h5 class="widget-user-desc text-right">Web Designer</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="user-profile.jpg" alt="User Avatar">
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
                     <h1>User information will show here</h1>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="name">ชื่อ</label>
                            <input type="text" v-model="form.name" id="name" name="name" placeholder="ชื่อ" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">อีเมล์</label>
                            <input type="text" v-model="form.email" id="email" name="email" placeholder="อีเมล์" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="address">ที่อยู่</label>
                        <textarea class="form-control" v-model="form.address" rows="2" id="address" name="address" placeholder="ที่อยู่ ..."></textarea>
                      </div>
                      <div class="form-group">
                            <label for="zipcode">รหัสไปรษณีย์</label>
                            <input type="text" v-model="form.zipcode" id="zipcode" name="zipcode" placeholder="รหัสไปรษณีย์" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="location">ที่ตั้ง</label>
                            <input type="text" v-model="form.location" id="location" name="location" placeholder="ที่ตั้ง" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="area">พื้นที่</label>
                            <input type="text" v-model="form.area" id="area" name="area" placeholder="พื้นที่" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="image">ภาพโปรไฟล์</label>
                        <div class="custom-file">
                          <input type="file" @change="updateProfile" class="form-control" id="image" name="image">
                          <div class="info-box">
                            <div class="info-box-content">
                                <img id='img-upload' src="" />
                            </div>
                            <span>ขนาดไฟล์ภาพไม่เกิน 2MB</span>
                        </div>
                        </div>
                        <div class="form-group">
                          <label for="image"></label>
                            <button type="submit" @click.prevent="updateInfo" class="btn btn-block btn-primary">แก้ไขข้อมูล</button>
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
                     type: '',
                     email: '',
                     password: '',
                     location:'',
                     zipcode:'',
                     area:'',
                     image:''
                 })    
            }
        },
        methods:{
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
                    
                    this.form.image = reader.result;

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

    $(document).ready( function() {
        $(document).on('change', '.btn-file :file', function() {
      var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#image").change(function(){
		    readURL(this);
		}); 	
	});
</script>
