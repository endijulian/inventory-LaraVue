<template>
  <div>
    <router-link to="/store-supplier" class="btn btn-primary"
      >Add Supplier</router-link
    >

    <div class="row">
      <div class="col-md-6 mt-5">
        <input
          type="text"
          v-model="searchTerm"
          class="form-control"
          placeholder="Search form.."
        />
      </div>

      <div class="col-lg-12 mb-4 mt-2">
        <!-- Simple Tables -->
        <div class="card">
          <div
            class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-primary">Supplier List</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>Phone</th>
                  <th>Shop Name</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(supplier, index) in filterSearch" :key="index.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ supplier.name }}</td>
                  <td><img :src="supplier.photo" alt="" id="em_photo" /></td>
                  <td>{{ supplier.phone }}</td>
                  <td>{{ supplier.shopname }}</td>
                  <td>{{ supplier.email }}</td>
                  <td>
                    <router-link
                      :to="{
                        name: 'edit-supplier',
                        params: { id: supplier.id },
                      }"
                      class="btn btn-sm btn-primary"
                      >Edit</router-link
                    >
                    <a
                      @click="deleteSupplier(supplier.id)"
                      class="btn btn-sm btn-danger text-white"
                      >Delete</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
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
      suppliers: [],
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.suppliers.filter((supplier) => {
        return supplier.name.match(this.searchTerm);
      });
    },
  },
  methods: {
    allSupplier() {
      axios
        .get("/api/supplier/")
        .then(({ data }) => (this.suppliers = data))
        .catch();
    },
    deleteSupplier(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/supplier/" + id)
            .then(() => {
              this.suppliers = this.suppliers.filter((supplier) => {
                return supplier.id != id;
              });
            })
            .catch(() => {
              this.$router.push({ name: "supplier" });
            });
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    },
  },
  created() {
    this.allSupplier();
  },
};
</script>

<style scoped>
#em_photo {
  height: 40px;
  width: 40px;
}
</style>