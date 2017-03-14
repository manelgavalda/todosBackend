<template>
  <form @submit.prevent="submit">
    <div class="form-group has-feedback">
      <input type="text" class="form-control" placeholder="Your Name Here" name="name" value="" v-model="name"/>
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
      <span class="help-block" v-text="errors.name">Help block with user</span>
    </div>
    <div class="form-group has-feedback">
      <input type="email" class="form-control" placeholder="Your Email Here" name="email" v-model="email" value=""/>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control" placeholder="Password Here" name="password" v-model="password"/>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control" placeholder="Password Here" name="password_confirmation" v-model="password_confirmation"/>
      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
    </div>
      <div class="row">
        <div class="col-xs-1">
          <label>
            <div class="checkbox_register icheck">
              <label>
                <input type="checkbox" name="terms">
              </label>
            </div>
          </label>
        </div><!-- /.col -->
        <div class="col-xs-6">
          <div class="form-group">
            <button type="button" class="btn btn-block btn-flat" data-toggle="modal" data-target="#termsModal">Acceptar condicions</button>
          </div>
        </div><!-- /.col -->
        <div class="col-xs-4 col-xs-push-1">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div><!-- /.col -->
      </div>
  </form>
</template>
<script>
  class Errors {
    /*
    * Constructor.
     */
    constructor(){
      this.errors = {}
    }

    //API

  }
  export default {
    mounted() {
      console.log('Registered Component')
    },
    data: function() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: true,
        errors: new Errors()
      }
    },
    methods: {
      submit(){
        console.log('submit')
        //Promise
        this.$http.post('/register', this.$data)
          .then((response) => {
            console.log(response)
          }
        )
          .catch((error) => {
            this.errors=error.response.data
            console.log(this.errors)
            errors.name=this.errors.name[0]
          }
        )
      }
    }
  }
</script>