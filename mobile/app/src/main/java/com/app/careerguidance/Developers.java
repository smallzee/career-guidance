package com.app.careerguidance;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class Developers extends AppCompatActivity {

    private List<List_students> mData = new ArrayList<>();
    private RecyclerView recyclerView;
    private RecyclerViewAdaptersDevelopers recyclerViewAdaptersDevelopers;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_developers);
        this.setTitle("About Developers");

        recyclerView = (RecyclerView) findViewById(R.id.my_recycler_view);
        recyclerViewAdaptersDevelopers = new RecyclerViewAdaptersDevelopers(mData);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(recyclerViewAdaptersDevelopers);

        String JSON_FILE = "{'error' : '1', " +
                "'0' : {'matric' : 'cs20180100560', 'name' : 'Aremu Comfort Oluwayemisi', 'level' : 'ND 2 FT'}, " +
                "'1' : {'matric' : 'cs20180101813', name : 'Suleiman Ajibola Mahmud', 'level' : 'ND 2 FT'}, " +
                "'2' : {'matric' : 'cs20180105016', name : 'Yekini Yusuf Adio', 'level' : 'ND 2 FT'}}";

        String matric,name,level;

        try {


            JSONObject object = new JSONObject(JSON_FILE);

            for (int ii =0; ii < object.length(); ii++){
                matric = object.getJSONObject(Integer.toString(ii)).getString("matric").toUpperCase();
                name = object.getJSONObject(Integer.toString(ii)).getString("name");
                level = object.getJSONObject(Integer.toString(ii)).getString("level");
                mData.add(new List_students(matric,name,level,Core.IMG_URL+matric+".jpg","0"));
            }

        }catch (JSONException e){
            e.printStackTrace();
        }
    }
}