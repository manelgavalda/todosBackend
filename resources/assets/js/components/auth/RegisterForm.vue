<template>
  <form @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)">
    <div class="form-group has-feedback has-error" :class="{'has-error' : form.errors.has('name')}">
      <input type="text" class="form-control" placeholder="Your Name Here" name="name" value="" v-model="form.name"
             @keydown="form.errors.clear('name')"/>
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
      <span class="help-block" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="email" class="form-control" placeholder="Your Email Here" name="email" v-model="form.email"
             value=""/>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control" placeholder="Password Here" name="password" v-model="form.password"/>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control" placeholder="Password Here" name="password_confirmation"
             v-model="form.password_confirmation"/>
      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-1">
        <label>
          <div class="checkbox_register icheck">
            <label>
              <input type="checkbox" checked name="terms">
            </label>
          </div>
        </label>
      </div><!-- /.col -->
      <div class="col-xs-6">
        <div class="form-group">
          <button type="button" class="btn btn-block btn-flat" data-toggle="modal" data-target="#termsModal">Acceptar
            condicions
          </button>
        </div>
      </div><!-- /.col -->
      <div class="col-xs-4 col-xs-push-1">
        <!--<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>-->
        <button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="form.errors.any()" >Register</button>
        <!--v-if="conntected" v-show="fa-spinner fa-spin"-->
      </div><!-- /.col -->
    </div>
  </form>
</template>
<script>

  import Form from '../../forms/Form'

  export default {
    mounted() {
      console.log('Registered Component')
    },
    data: function () {
      return {
        form: new Form({name: '', email: '', password: '', password_confirmation: '', terms: true})
      }
    },
    methods: {
      submit() {
        this.form.submit('post', '/register')
          .then(response => {
            console.log(response)
//            location.reload();
            alert('Ok!')
          })
          .catch(error => {
            console.log(error)
//            location.reload();
          })
      }
    }
  }
</script>