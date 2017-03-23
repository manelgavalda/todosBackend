import Errors from './Errors'
import axios from 'axios'

export default class Form {
  /*
   * Constructor.
   */
  constructor (fields) {

    this.clearOnSubmit = false

    this.originalFields = fields

    this.errors = new Errors()

    this.resetStatus()


    for (let field in fields) {
      this[field] = fields[field]
    }

    this.errors = new Errors()
  }

  /**
   * Reset fields
   */
  reset () {
    this.fields = {}
    for (let field in this.originalFields) {
      this[field] = ''
    }
    this.errors.clear()
  }

  clearOnSubmit () {
    this.clearOnSubmit = true
  }

  resetStatus () {
    this.errors.forget()
    this.submitting = false
    this.submitted = false
    this.succeeded = false
  }

  data () {
    let data = {}

    for (let field in this.originalFields) {
      data[field] = this[field]
    }

    return data
  }

  /**
   * Start processing the form.
   *
   */
  startProcessing () {
    this.errors.forget()
    this.submitting = true
    this.succeeded = false
  };

  /**
   * Finish processing the form.
   *
   */
  finishProcessing () {
    this.submitting = false
    this.submitted = false
    this.succeeded = true
  }

  /**
   * Finish processing the form on errors.
   */
  finishProcessingOnErrors () {
    this.submitting = false
    this.submitted = false
    this.succeeded = false
  }

  /**
   * Send a POST request to the given URL.
   *
   * @param url
   * @returns {*}
   */
  post (url) {
    return this.submit('post', url)
  }

  /**
   * Send a PUT request to the given URL.
   *
   * @param url
   * @returns {*}
   */
  put (url) {
    return this.submit('put', url)
  }

  /**
   * Send a PATCH request to the given URL.
   *
   * @param url
   * @returns {*}
   */
  patch (url) {
    return this.submit('patch', url)
  }

  /**
   * Send a DELETE request to the given URL.
   *
   * @param url
   * @returns {*}
   */
  delete (url) {
    return this.submit('delete', url)
  }

  submit (requestType, url) {
    this.connecting = true
    return new Promise((resolve, reject) => {
      axios[requestType](url, this.fields)
        .then((response) => {
          // this.connecting = false
          this.onSuccess(response)
          resolve(response)
        }
        )
        .catch((error) => {
          // this.connecting = false
          console.log(error)
          this.onFail(error.response.data)
          reject(error)
//              this.errors.record=error.response.data
//            console.log(this.errors)
//            errors.name=this.errors.name[0]
        }
        )
    })
  }

  /**
   * Process on success.
   */
  onSuccess () {
    this.finishProcessing()
    if (this.clearOnSubmit) this.reset()
  }

  /**
   * Process on fail.
   *
   * @param errors
   */
  onFail (errors) {
    this.errors.record(errors)
    this.finishProcessingOnErrors()
  }

  /**
   * Set the errors on the form.
   *
   * @param errors
   */
  setErrors (errors) {
    this.submitting = false
    this.errors.set(errors)
  };
}
