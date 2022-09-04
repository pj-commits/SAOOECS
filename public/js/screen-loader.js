document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
        document.querySelector(
          "body").style.visibility = "hidden";
        document.querySelector(
          "#loader").style.visibility = "visible";

    } else {
        setTimeout(() => {

            document.querySelector(
          "#loader").style.display = "none";
            
        }, 1000);

        document.querySelector(
          "body").style.visibility = "visible";
    }      
};