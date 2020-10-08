
 /*$(function(){
  var chart = new CanvasJS.Chart("chartContainer", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: titre
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: [
      { label: 'Extrême-Nord', y: 71 },
      { label: 'Nord', y: 55 },
      { label: 'Adamaoua', y: 50 },
      { label: 'Centre', y: 65 },
      { label: 'Est', y: 95 },
      { label: 'Littoral', y: 68 },
      { label: 'Sud', y: 28 },
      { label: 'Ouest', y: 34 },
      { label: 'Nord-Ouest', y: 14 },
      { label: 'Sud-Ouest', y: 24 },
      { label: 'Etranger', y: 7 }
      ]
    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: [
      { label: 'Extrême-Nord', y: 21 },
      { label: 'Nord', y: 24 },
      { label: 'Adamaoua', y: 25 },
      { label: 'Centre', y: 30 },
      { label: 'Est', y: 78 },
      { label: 'Littoral', y: 24 },
      { label: 'Sud', y: 12 },
      { label: 'Ouest', y: 10 },
      { label: 'Nord-Ouest', y: 4 },
      { label: 'Sud-Ouest', y: 50 },
      { label: 'Etranger', y: 3 }
      ]
    }
    ]
  });
  chart.render();
   $.ajax({
    url: base_url + 'statistiques/get_by_region',
    dataType: 'json',
    success: function(data){
      //alert(data.cdt_par_reg);
      //par_reg = data;
      //chart.options.dataPoints = data.cdt_par_reg;
      //chart.render();
    },
    error: function(){
      alert('erreur ajax');
    }
  });
});*/