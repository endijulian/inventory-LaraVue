<template>
  <div>
    <router-link to="/customer" class="btn btn-primary"
      >All Customer</router-link
    >

    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Customer Update</h1>
                  </div>
                  <form
                    class="user"
                    @submit.prevent="customerUpdate"
                    enctype="multipart/form-data"
                  >
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for=""><b>Customer Name</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your Name"
                            v-model="form.name"
                          />
                          <small class="text-danger" v-if="errors.name">{{
                            errors.name[0]
                          }}</small>
                        </div>

                        <div class="col-md-6">
                          <label for=""><b>Customer Email</b></label>
                          <input
                            type="email"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your Email"
                            v-model="form.email"
                          />
                          <small class="text-danger" v-if="errors.email">{{
                            errors.email[0]
                          }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for=""><b>Customer Address</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your Adsress"
                            v-model="form.address"
                          />
                          <small class="text-danger" v-if="errors.address">{{
                            errors.address[0]
                          }}</small>
                        </div>

                        <div class="col-md-6">
                          <label for=""><b>Phone Number</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your Phone Number"
                            v-model="form.phone"
                          />
                          <small class="text-danger" v-if="errors.phone">{{
                            errors.phone[0]
                          }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <input
                            type="file"
                            class="custom-file-input"
                            id="customFile"
                            placeholder="Enter Your Name"
                            @change="onFileSelected"
                          />
                          <small class="text-danger" v-if="errors.photo">{{
                            errors.photo[0]
                          }}</small>
                          <label for="customFile" class="custom-file-label"
                            >Choose File</label
                          >
                          <div class="col-md-6 mt-2">
                            <img
                              :src="form.photo"
                              alt=""
                              style="height: 100px; width: 100px"
                            />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Update
                      </button>
                    </div>

                    <hr />
                  </form>
                  <div class="text-center"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "/" });
    }
  },

  data() {
    return {
      form: {
        name: "",
        email: "",
        address: "",
        phone: "",
        newphoto: "",
        photo: "",
      },
      errors: {},
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/customer/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
  },
  methods: {
    onFileSelected(event) {
      // console.log(event);
      let file = event.target.files[0];
      if (file.size > 1048770) {
        Notification.image_validation();
      } else {
        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.newphoto = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    customerUpdate() {
      let id = this.$route.params.id;
      axios
        .patch("/api/customer/" + id, this.form)
        .then(() => {
          this.$router.push({ name: "customer" });
          Notification.success();
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>
<style type="text/css">
</style>