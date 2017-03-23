
export default class Errors {
  /*
   * Constructor.
   */
  constructor () {
    this.errors = {}
    let connecting = false
  }

  // API
  has (field) {
    // Underscore | Lodash
    return this.errors.hasOwnProperty(field)
  }

  /*
   *
   * Determine if we have any error
   *
   * */
  any () {
    return Object.keys(this.errors).length > 0
  }

  hasErrors () {
    return this.any()
  }

  all () {
    return this.errors
  }

  /**
   *
   * @param field
   * @returns {*}
   */
  get (field) {
    if (this.errors[field]) {
      return this.errors[field][0]
    }
  }

  onSuccess () {
    // TODO: si va be
    // EN algun cas faria falta reset, en aquest cas no this.reset
    // TODO: si va be

  }

  onFail () {
    // TODO: si va be
    this.errors.record(errors.response.data)
  }

  getAllErrors (field) {
    if (this.errors[field]) {
      return this.errors[field][0]
    }
  }

  /**
   *
   * @param errors
   */
  record (errors) {
    this.set(errors)
  }

  clear (field) {
    if (field) {
      delete this.errors[field]
      return
    }
    this.errors = {}
  }

  set (errors) {
    this.errors = errors
  }

  forget (field) {
    this.clear(field)
  }
}
