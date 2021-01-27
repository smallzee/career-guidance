package com.app.careerguidance;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Vibrator;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {

    Button developer,guidance;
    ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        developer = findViewById(R.id.developer);
        guidance = findViewById(R.id.guidance);

        developer.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(MainActivity.this, Developers.class));
            }
        });

        guidance.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                show_dialog();

                StringRequest request = new StringRequest(Request.Method.POST, Core.SITE_URL, new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        hide_dialog();

                        try {

                            JSONObject object = new JSONObject(response);
                            JSONObject data = object.getJSONObject("data");

                            if (data.getString("error").equals("0")){
                                vibrate();
                                toast_alert(data.getString("msg"));
                                return;
                            }

                            SharedPreferences.Editor sharedPreferences = getSharedPreferences("SCHOOL_DATA",MODE_PRIVATE).edit();
                            sharedPreferences.putString("school_data", response.toString());
                            sharedPreferences.commit();

                            startActivity(new Intent(MainActivity.this, Guidance.class));

                        }catch (JSONException e){
                            e.printStackTrace();
                        }
                        
                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        vibrate();
                        toast_alert("No internet connection, try again");
                        hide_dialog();
                    }
                }){
                    @Override
                    protected Map<String, String> getParams() throws AuthFailureError {
                        Map<String, String> param = new HashMap<>();
                        param.put("guidance", "");
                        return  param;
                    }
                };

                RequestQueue queue = Volley.newRequestQueue(MainActivity.this);
                queue.add(request);

            }
        });
    }


    public void vibrate() {
        Vibrator v = (Vibrator)getSystemService(Context.VIBRATOR_SERVICE);
        v.vibrate(100);
    }

    // toast alert
    public void toast_alert(String msg){
        Toast.makeText(this, msg, Toast.LENGTH_SHORT).show();
    }

    // show dialog
    public void show_dialog() {
        this.progressDialog = new ProgressDialog(this);
        this.progressDialog.setMessage("Please wait...");
        this.progressDialog.setCancelable(false);
        this.progressDialog.setIndeterminate(false);
        this.progressDialog.show();
    }

    //hide dialog
    public void hide_dialog() {
        this.progressDialog.hide();
    }
}