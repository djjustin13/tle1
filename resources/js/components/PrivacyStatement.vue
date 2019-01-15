<template>
<div>
  <router-link :to=" '/' " class="btn btn-link backbutton"><i class="fas fa-chevron-left"></i></router-link>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-md-6 col-lg-8 text-center statement">
        
        <h1 class="py-2 home-title">Privacy Statement</h1>
        <p>18 december 2018 door Hugo Caminada
          <br>Awareness010, gevestigd aan Wijnhaven 99 te Rotterdam, is verantwoordelijk voor de verwerking van persoonsgegevens zoals weergegeven in deze privacyverklaring.
        </p>
        <b>Contactgegevens:</b>
        <p>
          <a href="http://www.awareness010.nl" target="_blank">Awareness 010</a>
          <br>Wijnhaven 99 te Rotterdam
          <br>+31 06 13 16 21 28
        </p>
        <b>Persoonsgegevens die wij verwerken:</b>
        <p>Awareness010 verwerkt en bewaard geen persoonsgegevens omdat op onze site geen persoonsgegevens achter gelaten kunnen worden. Ook gebruiken we geen social media plugins.</p>
        <b>Bijzondere en/of gevoelige persoonsgegevens die wij verwerken:</b>
        <p>Awareness010 verwerkt de volgende bijzondere en/of gevoelige persoonsgegevens van u:
          <br>– gezondheid
        </p>
        <b>Met welk doel en op basis van welke grondslag wij persoonsgegevens verwerken:</b>
        <p>Awareness010 verwerkt uw persoonsgegevens voor de volgende doelen:
          <br>– Awareness010 analyseert uw gedrag op de website om daarmee de website te verbeteren en het aanbod van producten en diensten af te stemmen op uw voorkeuren.
        </p>
        <b>Geautomatiseerde besluitvorming:</b>
        <p>Awareness010 neemt wel op basis van geautomatiseerde verwerkingen besluiten over zaken die (aanzienlijke) gevolgen kunnen hebben voor personen. Het gaat hier om besluiten die worden genomen door computerprogramma’s of -systemen, zonder dat daar een mens (bijvoorbeeld een medewerker van Awareness010) tussen zit. Awareness010 gebruikt de volgende computerprogramma’s of -systemen:
          <br>We vergelijken uw input met de cijfers van het CBS (Centraal Bureau Statistiek) middels een door ons geschreven berekening. De cijfers van het CBS komen uit onze database, uw input en de resultaten van de berekeningen blijven op uw apparaat en worden niet naar Awareness010 gestuurd.
        </p>
        <b>Cookies, of vergelijkbare technieken, die wij gebruiken:</b>
        <p>
            Awareness010 gebruikt de <i>local storage</i>. De local storage is een klein tekstbestand dat bij gebruik van deze applicatie wordt opgeslagen op uw computer, tablet of smartphone. De bestanden in de local storage die wij gebruiken zijn noodzakelijk voor de technische werking van de website en uw gebruiksgemak. Ze zorgen ervoor dat de applicatie naar behoren werkt en onthouden bijvoorbeeld uw ingevoerde gewoontes. U kunt zich afmelden voor local storage en cookies door uw internetbrowser zo in te stellen dat deze geen cookies meer opslaat. Daarnaast kunt u ook alle informatie die eerder is opgeslagen via de instellingen van uw browser verwijderen.
        </p>
        <b>Gegevens inzien, aanpassen of verwijderen:</b>
        <p>
            U heeft het recht om uw ingevoerde gegevens in te zien, te corrigeren of te verwijderen. Dit kunt u zelf doen via de persoonlijke instellingen in onze applicatie.<br>

Wilt u gebruik maken van uw recht op bezwaar en/of recht op gegevensoverdraagbaarheid of heeft u andere vragen/opmerkingen over de gegevensverwerking, stuur dan een gespecificeerd verzoek naar hugoschmidt@me.com. <br>

Om er zeker van te zijn dat het verzoek tot inzage door u is gedaan, vragen wij u een kopie van uw identiteitsbewijs bij het verzoek mee te sturen. Maak in deze kopie uw pasfoto, MRZ (machine readable zone, de strook met nummers onderaan het paspoort), paspoortnummer en Burgerservicenummer (BSN) zwart. Dit ter bescherming van uw privacy. Awareness010 zal zo snel mogelijk, maar in ieder geval binnen vier weken, op uw verzoek reageren.<br>

Awareness010 wil u er tevens op wijzen dat u de mogelijkheid hebt om een klacht in te dienen bij de nationale toezichthouder, de Autoriteit Persoonsgegevens. Dat kan via de volgende link: <a href="https://autoriteitpersoonsgegevens.nl/nl/contact-met-de-autoriteit-persoonsgegevens/tip-ons" target="_blank">autoriteitpersoonsgegevens</a>
        </p>
        <b>Hoe wij persoonsgegevens beveiligen</b>
        <p>
            Awareness010 neemt de bescherming van uw gegevens serieus en neemt passende maatregelen om misbruik, verlies, onbevoegde toegang, ongewenste openbaarmaking en ongeoorloofde wijziging tegen te gaan. Als u de indruk heeft dat uw gegevens niet goed beveiligd zijn of er aanwijzingen zijn van misbruik, neem dan contact op met onze klantenservice of via hugo@awareness010.nl
        </p>
      </div>
    </div>
  </div>
</div>

</template>

<style lang="scss" scoped>
.backbutton {
  position: absolute;
  left: 10px;
  top: 5px;
  padding: 20px;
  z-index: 50;

  .fas{
    font-size: 1.5em;
    color: #FFFFFF;
  }
  
}
.statement{
  overflow: scroll;
  height: 100vh;
  &::-webkit-scrollbar { 
    display: none; 
  }
}

p {
  font-size: 1.35em;
}

b {
  font-size: 1.55em;
}
</style>


<script>


export default {
  name: "PrivacyStatement",
  created: function(){
    const disableBodyScroll = bodyScrollLock.disableBodyScroll;
    bodyScrollLock.disableBodyScroll(document.querySelector('.statement'));
  }
};
</script>