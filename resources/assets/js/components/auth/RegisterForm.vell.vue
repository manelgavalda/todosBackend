<template>
  <form method="post" @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)">
    <div class="form-group has-feedback has-error">
      <input type="text" class="form-control" placeholder="" name="name" value="" v-model="form.name" autofocus>
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
      <transition name="fade">
        <span class="help-block" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
      </transition>
    </div>
    <div class="form-group has-feedback">
      <input type="email" class="form-control" placeholder="Your Email Here" name="email" v-model="form.email"
             value=""/>
      <transition name="bounce"
                  enter-active-class="animated bounceIn"
                  leave-active-class="animated bounceOut">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </transition>

    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control" placeholder="Password Here" name="password" v-model="form.password"/>
      <transition name="fade">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </transition>
    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control" placeholder="Password Here" name="password_confirmation"
             v-model="form.password_confirmation"/>
      <transition name="fade">
      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </transition>
    </div>
        <div class="col-xs-7">
          <label>
            <div class="checkbox_register icheck">
              <label data-toggle="modal" data-target="#termsModal">
                <input type="checkbox" name="terms" v-model="form.terms" class="has-error">
                <a href="#" :class="{ 'text-danger': form.errors.has('terms') }">Terms and conditions</a>
              </label>
            </div>
          </label>
        </div>
      <div class="col-xs-4 col-xs-push-1">
        <!--<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>-->

        <button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="form.errors.any()"><i class="fa fa-refresh fa-spin" v-if="form.submitting"></i>Register</button>        <!--v-if="conntected" v-show="fa-spinner fa-spin"-->
      </div><!-- /.col -->
    <div id="demo">
    </div>
  </form>
</template>

<style>
  .fade-enter-active, .fade-leave-active{
    transition: opacity .5s ease;
  }

  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
</style>

<script>

  import Form from 'manelgavalda-forms'


  export default {
    mounted() {
      console.log('Registered Component')
      this.initializeICheck()
    },
    data: function () {
      return {
        form: new Form({name: '', email: '', password: '', password_confirmation: '', terms: true})
      }
    },
      watch: {
         'form.terms': function (value) {
           if(value) {
             $('input').iCheck('check')
           } else {
             $('input').iCheck('uncheck')
           }
         }
      },
    methods: {
      submit(requestType,url){
//        this.submitting = true
        return new Promise((resolve,reject) =>{
          axios[requestType](url,this.data())
            .then( response =>{
              this.onSuccess(response)
              resolve(response)
            }).catch(error => {
            this.onFail(error)
            reject(error)
          })
        })
      },
      initializeICheck() {
      console.log('Initialize')
      var vm = this
        $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%',
        inheritClass: true
      }).on('ifChecked', function(event){
       vm.form.set('terms',true)
       vm.form.errors.clear('terms')
       }).on('ifUnchecked', function(event){
       vm.form.set('terms','')
      });
    }
    }
  }
</script>