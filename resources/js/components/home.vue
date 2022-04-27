<template>
  <div>
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </div>

      <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">
                    Today Sell Amount
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    $ {{ todaysell }}
                  </div>
                  <div class="mt-2 mb-0 text-muted text-xs">
                    <span class="text-success mr-2"
                      ><i class="fa fa-arrow-up"></i> 3.48%</span
                    >
                    <span>Since last month</span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-primary"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">
                    Today Income
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    $ {{ income }}
                  </div>
                  <div class="mt-2 mb-0 text-muted text-xs">
                    <span class="text-success mr-2"
                      ><i class="fas fa-arrow-up"></i> 12%</span
                    >
                    <span>Since last years</span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-shopping-cart fa-2x text-success"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- New User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">
                    Today Due
                  </div>
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    $ {{ due }}
                  </div>
                  <div class="mt-2 mb-0 text-muted text-xs">
                    <span class="text-success mr-2"
                      ><i class="fas fa-arrow-up"></i> 20.4%</span
                    >
                    <span>Since last month</span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-info"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">
                    Expense
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    $ {{ expense }}
                  </div>
                  <div class="mt-2 mb-0 text-muted text-xs">
                    <span class="text-danger mr-2"
                      ><i class="fas fa-arrow-down"></i> 1.10%</span
                    >
                    <span>Since yesterday</span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comments fa-2x text-warning"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
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
              Out Of Stock Product
            </h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Photo</th>
                  <th>Buying Price</th>
                  <th>Status</th>
                  <th>Quantity</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product, index) in products" :key="index.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ product.product_name }}</td>
                  <td>{{ product.product_code }}</td>
                  <td><img :src="product.image" alt="" id="em_photo" /></td>
                  <td>{{ product.buying_price }}</td>
                  <td v-if="product.product_quantity >= 1">
                    <span class="badge badge-success">Available</span>
                  </td>
                  <td v-else>
                    <span class="badge badge-danger">Stock Out</span>
                  </td>
                  <td>{{ product.product_quantity }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
    <!---Container Fluid-->
  </div>
</template>

<script type="text/javascript">
export default {
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "/" });
    }
  },

  data() {
    return {
      todaysell: "",
      income: "",
      due: "",
      expense: "",
      products: "",
    };
  },
  mounted() {
    this.todaySell();
    this.todayIncome();
    this.todayDue();
    this.todayExpense();
    this.StockOut();
  },
  methods: {
    todaySell() {
      axios
        .get("/api/today/sell/")
        .then(({ data }) => (this.todaysell = data))
        .catch((error) => (this.errors = error.response.data.errors));
    },
    todayIncome() {
      axios
        .get("/api/today/income/")
        .then(({ data }) => (this.income = data))
        .catch((error) => (this.errors = error.response.data.errors));
    },
    todayDue() {
      axios
        .get("/api/today/due/")
        .then(({ data }) => (this.due = data))
        .catch((error) => (this.errors = error.response.data.errors));
    },
    todayExpense() {
      axios
        .get("/api/today/expense/")
        .then(({ data }) => (this.expense = data))
        .catch((error) => (this.errors = error.response.data.errors));
    },
    StockOut() {
      axios
        .get("/api/today/stockout/")
        .then(({ data }) => (this.products = data))
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>

<style scoped>
#em_photo {
  width: 40px;
  height: 40px;
}
</style>