import Errors from './Errors'

export default class Form {
  /*
   * Constructor.
   */
  constructor (originalFields) {
    this.fields = {}

    this.fields = originalFields

    for (let field in originalFields) {
      this[field] = originalFields[field]
    }

    this.errors = new Errors()
  }

  /**
   * Reset fields
   */
  reset () {
    this.fields = {}
    for (let field in originalFields) {
      this[field] = ''
    }
    this.errors.clear()
  }

  data () {
    let data = {}

    for (let field in this.fields) {
      data[field] = this[field]
    }
  }

  submit (requestType, url) {
    this.connecting = true
    return new Promise((resolve, reject) => {
      this.$http[requestType](url, this.fields)
        .then((response) => {
          this.connecting = false
          this.onSuccess(response)
          resolve(response)
        }
        )
        .catch((error) => {
          this.connecting = false
          console.log(error)
          this.onFail(error)
          reject(error)
//              this.errors.record=error.response.data
//            console.log(this.errors)
//            errors.name=this.errors.name[0]
        }
        )
    })
  }
}
