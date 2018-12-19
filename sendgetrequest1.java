package com.chillyfacts.com;
import java.io.BufferedReader;
public class sendhttprequest {
	public static void main (String[] args) {
		try {
			sendhttprequest.call();
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	public static void call() throws Exception {
		String url = "https://my-json-server.typicode.com/qonitasa/apitravel/api/?key=1a&name=Mallory%20Acarson&format=json";
		URL obj = new URL(url);
		HttpURLConnection con = (HttpURLConnection) obj.openConnection();
		// optional default is GET
		con.setRequestMethod("GET");
		//add request header
		con.setRequestProperty("User-Agent", "Chrome/71.0.3578.98");
		int responseCode = con.getResponseCode();
		System.out.println("\nSending 'GET' request to URL : " + url);
		System.out.println("Response Code : " + responseCode);
		BufferedReader in = new BufferedReader(
			 new InputStreamReader(con.getInputStream()));
		String inputLine;
		StringBuffer response = new StringBuffer();
		while ((inputLine = in.readLine()) != null) {
			response.append(inputLine);
		}
		in.close();
		//print in String
		System.out.println(response.toString());
		//Read JSON response and print
		JSONObject myResponse = new JSONObject(response.toString());
		System.out.println("result after Reading JSON Response");
		System.out.println("route- "+myResponse.getString("route"));
		System.out.println("departure_time- "+myResponse.getString("departure_time"));
		System.out.println("arrival_time- "+myResponse.getString("arrival_time"));
   }
}
