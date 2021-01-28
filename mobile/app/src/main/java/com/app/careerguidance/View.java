package com.app.careerguidance;

import androidx.appcompat.app.AppCompatActivity;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class View extends AppCompatActivity {

    public String response;
    SharedPreferences sharedPreferences;
    TextView description;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view);

        description = findViewById(R.id.description);
        Bundle bundle = getIntent().getExtras();
        String view_id,id;

        view_id = bundle.getString("view_id");

        sharedPreferences = getSharedPreferences("SCHOOL_DATA",MODE_PRIVATE);
        response = sharedPreferences.getString("school_data", null);


        try {

            JSONObject object = new JSONObject(response);
            JSONArray data = object.getJSONArray("school_data");

            for(int i =0; i < data.length(); i++){

                JSONObject school_data = data.getJSONObject(i);
                id = school_data.getString("id");

                if (view_id.equals(id)){
                    this.setTitle(school_data.getString("name"));
                    description.setText(school_data.getString("description"));
                    break;
                }

            }

        }catch (JSONException e){
            e.printStackTrace();
        }

    }
}