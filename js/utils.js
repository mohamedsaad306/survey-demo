        function getParameterByName(name, url) {
        	if (!url) url = window.location.href;
        	name = name.replace(/[\[\]]/g, "\\$&");
        	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        	results = regex.exec(url);
        	if (!results) return null;
        	if (!results[2]) return '';
        	return decodeURIComponent(results[2].replace(/\+/g, " "));

        	
        }
        function getSurveyData(surveyid,successCallback) {
        	var result;
        	request = $.ajax({
        		url: "api.php?action=GetSurveyData&surveyid="+surveyid,
        		type: "GET",
				//data: serializedData
			});

        	request.done(function (response, textStatus, jqXHR){

        		result = response;
        		if (successCallback) {
        			successCallback(result);
        		}
        	});

        	request.fail(function (jqXHR, textStatus, errorThrown){
        		console.error(
        			"The following error occurred: "+textStatus, errorThrown	
        			);
        	});


        	return result;
        }

        