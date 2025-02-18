function load_on_iframe() {
    document.getElementById("iframeonclick").setAttribute("onClick", "");
    document.getElementById("iframeonclick").className = document.getElementById("iframeonclick").className.replace(/(?:^|\s)hidden(?!\S)/g, "");
    document.getElementById("iframeonclick").src =
    "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3178.576875452628!2d-3.602639923716672!3d37.186525345826674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd71fcc2f58c33ff%3A0x1b7417ba0588002e!2sC.%20Real%20de%20Cartuja%2C%20Albaic%C3%ADn%2C%2018012%20Granada!5e0!3m2!1ses!2ses!4v1739913956077!5m2!1ses!2ses";
     }
