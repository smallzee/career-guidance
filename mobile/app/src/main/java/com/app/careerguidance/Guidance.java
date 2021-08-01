package com.app.careerguidance;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class Guidance extends AppCompatActivity {

    public List<Lists> mData = new ArrayList<>();
    public RecyclerView recyclerView;
    public RecyclerViewAdapters recyclerViewAdapters;
    public String response;
    SharedPreferences sharedPreferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_guidance);

        recyclerView = (RecyclerView) findViewById(R.id.my_recycler_view);
        recyclerViewAdapters = new RecyclerViewAdapters(mData);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(recyclerViewAdapters);

        this.setTitle("List FPE Schools Guidance");

        sharedPreferences = getSharedPreferences("SCHOOL_DATA",MODE_PRIVATE);
        response = sharedPreferences.getString("school_data", null);

        String id,name,description;

        try {
            JSONObject object = new JSONObject(response);
            JSONArray data = object.getJSONArray("school_data");

            for (int i =0; i < data.length(); i++){
                JSONObject school_data = data.getJSONObject(i);

                id = school_data.getString("id");
                name = school_data.getString("name");
                description = school_data.getString("description");

                mData.add(new Lists(name,description,"",Core.SITE_URL+"images/logo.png",id,"true"));
            }

        }catch (JSONException e){
            e.printStackTrace();
        }


    }
}