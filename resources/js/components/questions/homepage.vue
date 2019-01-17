
<template>
  <div class="background">
    <!-- Modal for PWA Notification -->
          <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Download de app!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Download onze applicatie via het 'Deel'-venster van je browser.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
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
            <button v-if="mobile" type="button" data-toggle="modal" data-target="#myModal">Launch modal</button>
            <button type="button" v-else="">Geen modal</button>
          </div>  
        </div>
        
      </div>
    </div>
  </div> 
</template>

<script>
let mobile = ["iPhone", "iPad", "iPod", "Android", "MacIntel"].includes(navigator.platform);

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
    },
  },
  mounted: function(){

    localStorage.clear();
      
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
</style>


