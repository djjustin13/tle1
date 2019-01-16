
<template>
  <div class="background">
    <div class="question">
      <div class="container">
        <div v-if="error" class="alert alert-light" role="alert">{{ error }}</div>

        <div class="row justify-content-center">
          <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
            <h1 class="py-2 home-title">Awareness 010</h1>
            <h2>Verlaag stap voor stap jouw ecologische voetafdruk!</h2>
            <img class="card-img" src="/img/sun_panel_500x500.png" alt="sun">

            <div class="py-4">
              <button class="btn btn-light question-btn px-3" @click="nextSlide()">Start de vragen!</button>
            </div>

            <div class="ula-container">
              <p>Wil je weten wat we met jouw data doen? lees
                <router-link :to=" '/privacy' " class="btn btn-link">Privacy Statement</router-link>
              </p>
            </div>
          </div>

          <!-- Modal for PWA Notification -->
          <div v-if="mobile">
          <transition name="modal">
            <div class="modal-mask">
              <div class="modal-wrapper">
                <div class="modal-container">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h5 name="header">Download de applicatie!</h5>
                  </div>

                  <!-- Modal Body -->
                  <div class="modal-body">
                    <p
                      name="body"
                    >Je kunt deze applicatie downloaden door op te tikken in je browser.</p>
                  </div>

                  <div class="modal-footer">
                    <button class="modal-default-button" @click="$emit('close')">Cool</button>
                  </div>
                </div>
              </div>
            </div>
          </transition>
          </div>
          <div v-else></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
let mobile = ["iPhone", "iPad", "iPod", "Android"].includes(navigator.platform);
export default {
  name: "homepage",
  data() {
    return {
      mobile,
      error: null
    };
  },
  methods: {
    nextSlide: function() {
      $(".slider").slick("slickNext");
    }
  }
};
</script>

<style lang="scss" scoped>
.question-btn {
  color: #54c0eb;
  width: 70%;
}

.background {
  // background: linear-gradient(-100deg,#23A6D5, #23D5AB) !important;
  // background-size: 400% 400%;
  // animation: Gradient 15s ease infinite;
  background-color: #54c0eb;
}

.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}
/* Styles for Modal */
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>


