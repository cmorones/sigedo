 $(document).ready(function() {
    $("#btnExport").click(function(e) {
        alert('excel');
        //getting values of current time for generating the file name
        var dt = new Date();
        var day = dt.getDate();
        var month = dt.getMonth() + 1;
        var year = dt.getFullYear();
        var hour = dt.getHours();
        var mins = dt.getMinutes();
        var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table

        var data_type = 'data:application/vnd.ms-excel;charset=UTF-8;base64';
        
        var table_div = document.getElementById('datos');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.charset ="UTF-8";
        a.href = data_type + ', ' + ces(table_html);
        //setting the file name
        a.download = 'informedd_' + postfix + '.xlsx';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        //e.preventDefault();
    });
});

   function ces(s) {
                                    while (s.indexOf('â') != -1) s = s.replace('â','a');
                                    while (s.indexOf('ş') != -1) s = s.replace('ş','s');
                                    while (s.indexOf('ă') != -1) s = s.replace('ă','a');
                                    while (s.indexOf('ţ') != -1) s = s.replace('ţ','t');
                                    return window.btoa(unescape(s))
                                }

