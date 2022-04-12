<template>
  <div>
    <router-link to="/salary" class="btn btn-primary">Go Back</router-link>

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
            <h6 class="m-0 font-weight-bold text-primary">
              Employee Salary Details
            </h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Month</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(salary, index) in filterSearch" :key="index.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ salary.name }}</td>
                  <td>{{ salary.salary_month }}</td>
                  <td>{{ salary.amount }}</td>
                  <td>{{ salary.salary_date }}</td>
                  <td>
                    <router-link
                      :to="{
                        name: 'edit-salary',
                        params: { id: salary.id },
                      }"
                      class="btn btn-sm btn-primary"
                      >Edit Salary</router-link
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
      salaries: [],
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.salaries.filter((salary) => {
        return salary.name.match(this.searchTerm);
      });
    },
  },
  methods: {
    viewSalary() {
      let id = this.$route.params.id;
      axios
        .get("/api/salary/view/" + id)
        .then(({ data }) => (this.salaries = data))
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
  created() {
    this.viewSalary();
  },
};
</script>

<style scoped>
#em_photo {
  height: 40px;
  width: 40px;
}
</style>