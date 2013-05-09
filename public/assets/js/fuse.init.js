var myLayout; // a var is required because this page utilizes: myLayout.allowOverflow() method

$(document).ready(function () {
  if($('div.mine-layer').length != 0)
    myLayout = $('div.mine-layer').layout({
      applyDefaultStyles: true
  //     , stateManagement__enabled:	true
      , west__size: 300
      , west__initClosed: true
    });

  if($('div.mine-layer-advanced').length != 0){
    myLayout = $('div.mine-layer-advanced').layout({
      applyDefaultStyles: true
  //     , stateManagement__enabled:	true
    });

    $('div.mine-layer-advanced-center-inner').layout({
      applyDefaultStyles: true
      , stateManagement__enabled:	true
    });
  }
});