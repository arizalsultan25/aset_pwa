<template>
  <div class="main-panel">
    <div class="content">
      <div class="page-inner">
        <div class="col-md-12">
          <h4 class="page-title">Profile Pengguna</h4>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12 col-lg-4">
            <div class="card card-profile">
              <div
                class="card-header"
                style="background-image: url('./img/blogpost.jpg')"
              >
                <div class="profile-picture">
                  <div class="avatar avatar-xl">
                    <img
                      :src="'/img/profile.png'"
                      alt="..."
                      class="avatar-img rounded-circle"
                    />
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="user-profile text-center">
                  <div class="name">{{ $store.state.data.name }}</div>
                  <div class="job" v-if="$store.state.data.role == 0">
                    Administrator
                  </div>
                  <div class="job" v-else>
                    Staff Divisi {{ $store.state.data.divisi }}
                  </div>

                  <div class="desc" v-if="$store.state.data.role == 0">
                    Super User
                  </div>
                  <div class="desc" v-else>
                    Anggota dari divisi {{ $store.state.data.divisi }} 
                  </div>

                  <div class="social-media">
                    <a
                      class="btn btn-info btn-twitter btn-sm btn-link"
                      href="#"
                    >
                      <span class="btn-label just-icon"
                        ><i class="flaticon-twitter"></i>
                      </span>
                    </a>
                    <a
                      class="btn btn-danger btn-sm btn-link"
                      rel="publisher"
                      href="#"
                    >
                      <span class="btn-label just-icon"
                        ><i class="flaticon-google-plus"></i>
                      </span>
                    </a>
                    <a
                      class="btn btn-primary btn-sm btn-link"
                      rel="publisher"
                      href="#"
                    >
                      <span class="btn-label just-icon"
                        ><i class="flaticon-facebook"></i>
                      </span>
                    </a>
                    <a
                      class="btn btn-danger btn-sm btn-link"
                      rel="publisher"
                      href="#"
                    >
                      <span class="btn-label just-icon"
                        ><i class="flaticon-dribbble"></i>
                      </span>
                    </a>
                  </div>
                  <!-- <div class="view-profile">
                                        <a href="#" class="btn btn-secondary btn-block">View Full Profile</a>
                                    </div> -->
                </div>
              </div>
              <div class="card-footer">
                <div class="row user-stats text-center">
                  <div class="col">
                    <div class="number">125</div>
                    <div class="title">Post</div>
                  </div>
                  <div class="col">
                    <div class="number">25K</div>
                    <div class="title">Followers</div>
                  </div>
                  <div class="col">
                    <div class="number">134</div>
                    <div class="title">Following</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->

          <div class="col-md-12 col-sm-12 col-12 col-lg-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Profile</h4>
              </div>
              <div class="card-body">
									<ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
										<li class="nav-item submenu">
											<a class="nav-link active show" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
												<i class="flaticon-home"></i>
												Home
											</a>
										</li>
										<li class="nav-item submenu">
											<a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
												<i class="flaticon-user-1"></i>
												Profile
											</a>
										</li>
										<li class="nav-item submenu">
											<a class="nav-link" id="pills-change-password-tab-icon" data-toggle="pill" href="#pills-change-password-icon" role="tab" aria-controls="pills-change-password-icon" aria-selected="false">
												<i class="flaticon-user-5"></i>
												Ubah Password
											</a>
										</li>
									</ul>
									<div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
										<div class="tab-pane fade active show" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
											<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

											<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
										</div>
										<div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
											<form
                          class="form-horizontal"
                          @submit.prevent="editProfile"
                        >
                          <div class="form-group row">
                            <label
                              for="inputName"
                              class="col-sm-2 col-form-label"
                              >ID</label
                            >
                            <div class="col-sm-10">
                              <input
                                type="text"
                                class="form-control"
                                :value="data.id"
                                disabled
                              />
                            </div>
                          </div>
                          <div class="form-group row">
                            <label
                              for="inputEmail"
                              class="col-sm-2 col-form-label"
                              >Email</label
                            >
                            <div class="col-sm-10">
                              <input
                                type="email"
                                class="form-control"
                                v-model="data.email"
                              />
                            </div>
                          </div>
                          <div class="form-group row">
                            <label
                              for="inputName2"
                              class="col-sm-2 col-form-label"
                              >Name</label
                            >
                            <div class="col-sm-10">
                              <input
                                type="text"
                                class="form-control"
                                v-model="data.nama"
                              />
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">
                                Submit
                              </button>
                            </div>
                          </div>
                        </form>
										</div>
										<div class="tab-pane fade" id="pills-change-password-icon" role="tabpanel" aria-labelledby="pills-change-password-tab-icon">
											 <form
                          class="form-horizontal"
                          @submit.prevent="changePassword"
                        >
                          <div class="form-group">
                            <label for="password">Password Lama</label>
                            <input
                              type="password"
                              maxlength="12"
                              placeholder="Password lama"
                              class="form-control"
                              v-model="form.pass_lama"
                            />
                          </div>

                          <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input
                              type="password"
                              maxlength="12"
                              placeholder="Password baru"
                              class="form-control"
                              v-model="form.pass_baru"
                            />
                          </div>

                          <div class="form-group">
                            <label for="password">Konfirmasi Password baru</label>
                            <input
                              type="password"
                              maxlength="12"
                              placeholder="Konfirmasi password baru"
                              class="form-control"
                              v-model="form.pass_confirm"
                            />
                          </div>

                          <div class="form-group row">
                            <div class="ml-3">
                              <button type="submit" class="btn btn-danger">
                                Submit
                              </button>
                            </div>
                          </div>
                        </form>
										</div>
									</div>
              </div>
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import
import Breadcrumb from "../../components/Breadcrumb.vue";
import axios from "axios";

export default {
  name: "IndexUser",
  components: {
    breadcrumb: Breadcrumb,
  },
  created() {
    this.getUserData();
  },
  data() {
    return {
      data: {
        nama: "",
        email: "",
        id: "",
      },

      form: {
        pass_baru: null,
        pass_lama: null,
        pass_confirm: null,
      },
    };
  },
  mounted(){
    this.getUserData()
  },

  methods: {
    async getUserData() {
      let token = this.$store.state.token;
      await axios.get(`/api/user-authenticated/${token}`).then((response) => {
        let row = response.data.data;
        this.data.nama = row.name;
        this.data.email = row.email;
        this.data.id = row.id;
      });
    },

    async editProfile() {
      // localStorage.setItem("nama", this.data.nama)
      // this.$store.state.data.name = localStorage.getItem("nama");
      try {
        // console.log(this.data);
        let token = localStorage.getItem("token");
        let uri = "/api/users/update/" + token;
        let response = await axios.post(uri, this.data);
        if (response.status == 200) {
          this.$toasted.show(
            "Data Pengguna telah diperbarui, perubahan akan diterapkan setelah logout",
            {
              type: "success",
              duration: 3000,
            }
          );
        }
      } catch (e) {
        this.errors = e.response.data.errors;

        this.$toasted.show("Something went wrong...", {
          type: "error",
          duration: 3000,
        });
      }
    },

    async changePassword() {
      try {
        // console.log(this.data);

        if (this.form.pass_baru !== this.form.pass_confirm) {
          this.$toasted.show("password konfirmasi tidak cocok", {
            type: "error",
            duration: 3000,
          });
          return 0;
        }

        let token = localStorage.getItem("token");
        let uri = "/api/users/change-password/" + token;
        let response = await axios.post(uri, this.form);
        if (response.status == 200) {
          this.$toasted.show(response.data.message, {
            type: response.data.status,
            duration: 3000,
          });

          this.form.pass_baru = "";
          this.form.pass_lama = "";
          this.form.pass_confirm = "";
        }
      } catch (e) {
        this.errors = e.response.data.errors;

        this.$toasted.show("Something went wrong...", {
          type: "error",
          duration: 3000,
        });
      }
    },
  },
};
</script>

<style>
</style>
