<template>
  <form @submit.prevent="submit" @keydown="errors.clear($event.target.name)">
    <div class="form-group has-feedback has-error">
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
        <button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="errors.any()" v-if="conntected" v-show="fa-spinner fa-spin">Register</button>
      </div><!-- /.col -->
    </div>
  </form>
</template>
<script>

  //  Errors = import './Errors.vue'

  class Form {
    /*
     * Constructor.
     */
    constructor(originalFields) {

      new Errors()

      this.fields = originalFields;

      for (let field in originalFields) {
        this[field] = originalFields[field]
      }
    }

    /*
     */
  }
  class Errors {
    /*
     * Constructor.
     */
    constructor() {
      this.errors = {}
      let connecting=false
    }

    //API
    has(field) {
      // Underscore | Lodash
      return this.errors.hasOwnProperty(field)
    }

    /*
     *
     * Determine if we have any error
     *
     * */
    any() {
      return Object.keys(this.errors).length > 0
    }

    /**
     *
     * @param field
     * @returns {*}
     */
    get(field) {
      if (this.errors[field]) {
        return this.errors[field][0]
      }
    }

    /**
     * Reset fields
     */
    reset() {
      this.fields = {}
      for (let field in originalFields) {
        this[field] = ''
      }
      this.errors.clear()
    }

    data() {
      let data = {}

      for(let field in this.fields){
        data[field] = this[field]
      }
    }

    submit(requestType, url) {
      this.connecting=true
      return new Promise((resolve, reject) => {
        this.$http[requestType](url, this.fields)
          .then((response) => {
            this.connecting=false
              this.onSuccess(response)
              resolve(response)
            }
          )
          .catch((error) => {
              this.connecting=false
              this.onFail(error);
              reject(error)
//              this.errors.record=error.response.data
//            console.log(this.errors)
//            errors.name=this.errors.name[0]
            }
          )
      })
      //Promise
    }


    onSuccess() {
      //TODO: si va be
      //EN algun cas faria falta reset, en aquest cas no this.reset
      //TODO: si va be

    }

    onFail() {
      //TODO: si va be
      this.errors.record(errors.response.data)

    }

    getAllErrors(field) {
      if (this.errors[field]) {
        return this.errors[field][0]
      }
    }

    /**
     *
     * @param errors
     */
    record(errors) {
      this.errors = errors
    }

    clear(field) {
      if (field) {
        delete this.errors[field]
        return;
      }
      this.errors = {};
    }

  }
  export default {
    mounted() {
      console.log('Registered Component')
    },
    data: function () {
      return {
        form: new Form({name: '', email: '', password: '', password_confirmation: '', terms: true}),
//        name: '',
//        email: '',
//        password: '',
//        password_confirmation: '',
//        terms: true,
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
            console.log(error.response.data)
//            location.reload();
          })
      }
    }
  }
</script>