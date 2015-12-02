window.onload = function(){
    var version = 1;

    if (version == 1){
        $('#query1').click(function(){
        $.post("query1.php",
                {
                    query_type: "1",
                    ename: $('#query1_input').val(),
                    limit1: $('#limit1').val(),
                    limit2: $('#limit2').val()
                },
                function (data, status) {  
                    if (status == "success") {
                        $('#result').empty();
                        console.log(data);
                        var response = JSON.parse(data);

                        for (var i=0; i < response.length; ++i){
                            var newDivNode = $("<div>");
                            newDivNode.attr("class", "subdiv");
                            newDivNode.html(response[i]['Entity_ID'] + '\t' + response[i]['name']);
                            newDivNode.appendTo($('#result'));
                        }
                        $('#num_result').text("find " + response.length + " results");
                    }
                }
            );
        });

        $('#query2').click(function(){
            $.post("query1.php",
                    {
                        query_type: "2",
                        eid: $('#query2_input').val(),
                        limit1: $('#limit1').val(),
                        limit2: $('#limit2').val(),
                    },
                    function (data, status) {
                        if (status == "success") {
                            $('#result').empty();
                            var response = JSON.parse(data);

                            for (var i=0; i < response.length; ++i){
                                var newDivNode = $("<div>");
                                newDivNode.attr("class", "subdiv");
                                newDivNode.html(response[i]['Type_URI']);
                                newDivNode.appendTo($('#result'));
                            }
                            $('#num_result').text("find " + response.length + " results");
                        }
                    }
                );
        });

        $('#query3').click(function(){
            $.post("query1.php",
                    {
                        query_type: "3",
                        eid: $('#query3_input').val(),
                        limit1: $('#limit1').val(),
                        limit2: $('#limit2').val(),
                    },
                    function (data, status) {
                        if (status == "success") {
                            $('#result').empty();
                            var response = JSON.parse(data);

                            for (var i=0; i < response.length; ++i){
                                var newDivNode = $("<div>");
                                newDivNode.attr("class", "subdiv");
                                newDivNode.html(response[i]['Property_URI']);
                                newDivNode.appendTo($('#result'));
                            }
                            $('#num_result').text("find " + response.length + " results");
                        }
                    }
                );
        });

        $('#query4').click(function(){
            $.post("query1.php",
                    {
                        query_type: "4",
                        eid: $('#query4_input').val(),
                        limit1: $('#limit1').val(),
                        limit2: $('#limit2').val(),
                    },
                    function (data, status) {
                        if (status == "success") {
                            $('#result').empty();
                            var response = JSON.parse(data);

                            for (var i=0; i < response.length; ++i){
                                var newDivNode = $("<div>");
                                newDivNode.attr("class", "subdiv");
                                newDivNode.html(response[i]['s'] + '\t' + response[i]['o']);
                                newDivNode.appendTo($('#result'));
                            }
                            $('#num_result').text("find " + response.length + " results");
                        }
                    }
                );
        });

        $('#query5').click(function(){
            $.post("query1.php",
                    {
                        query_type: "5",
                        tid: $('#query5_input').val(),
                        limit1: $('#limit1').val(),
                        limit2: $('#limit2').val(),
                    },
                    function (data, status) {
                        if (status == "success") {
                            console.log(data);
                            $('#result').empty();
                            var response = JSON.parse(data);

                            for (var i=0; i < response.length; ++i){
                                var newDivNode = $("<div>");
                                newDivNode.attr("class", "subdiv");
                                newDivNode.html(response[i]['Entity_ID'] + '\t' + response[i]['Type_URI']);
                                newDivNode.appendTo($('#result'));
                            }
                            $('#num_result').text("find " + response.length + " results");
                        }
                    }
                );
        });

        $('#query6').click(function(){
            $.post("query1.php",
                    {
                        query_type: "6",
                        tid: $('#query6_input').val(),
                        limit1: $('#limit1').val(),
                        limit2: $('#limit2').val(),
                    },
                    function (data, status) {
                        if (status == "success") {
                            $('#result').empty();
                            var response = JSON.parse(data);

                            for (var i=0; i < response.length; ++i){
                                var newDivNode = $("<div>");
                                newDivNode.attr("class", "subdiv");
                                newDivNode.html(response[i]['Type_URI']);
                                newDivNode.appendTo($('#result'));
                            }
                            $('#num_result').text("find " + response.length + " results");
                        }
                    }
                );
        });

        $('#query7').click(function(){
            $.post("query1.php", 
                    {
                        query_type: "7",
                        pid: $('#query7_input').val(),
                        limit1: $('#limit1').val(),
                        limit2: $('#limit2').val(),
                    },
                    function (data, status) {
                        if (status == "success") {
                            console.log(data);
                            $('#result').empty();
                            var response = JSON.parse(data);

                            for (var i=0; i < response.length; ++i){
                                var newDivNode = $("<div>");
                                newDivNode.attr("class", "subdiv");
                                newDivNode.html(response[i]['s'] + '\t' + response[i]['o']);
                                newDivNode.appendTo($('#result'));
                            }
                            $('#num_result').text("find " + response.length + " results");
                        }
                    }
                );
        });
    } else if (version == 2){

    }

    
};



