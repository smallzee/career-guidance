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

    public List<Lists> mData = new ArrayList<>();
    public RecyclerView recyclerView;
    public RecyclerViewAdapters recyclerViewAdapters;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_developers);
        this.setTitle("About Developers");

        recyclerView = (RecyclerView) findViewById(R.id.my_recycler_view);
        recyclerViewAdapters = new RecyclerViewAdapters(mData);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(recyclerViewAdapters);

        String JSON_FILE = "{'error' : '1', " +
                "'0' : {'matric' : 'Aremu Comfort Oluwayemisi', 'name' : 'CS20180100560', 'level' : 'ND 2 FT', 'phone' : '07068902635'}, " +
                "'1' : {'matric' : 'Suleiman Ajibola Mahmud', name : 'CS20180101813', 'level' : 'ND 2 FT','phone' : '08086913322'}, " +
                "'2' : {'matric' : 'Yekini Yusuf Adio', name : 'CS20180105016', 'level' : 'ND 2 FT', 'phone' : '08081717553'}}";

        String matric,name,level,phone;

        try {


            JSONObject object = new JSONObject(JSON_FILE);

            for (int ii =0; ii < object.length(); ii++){
                matric = object.getJSONObject(Integer.toString(ii)).getString("matric").toUpperCase();
                name = object.getJSONObject(Integer.toString(ii)).getString("name");
                level = object.getJSONObject(Integer.toString(ii)).getString("level");
                phone = object.getJSONObject(Integer.toString(ii)).getString("phone");

                mData.add(new Lists(matric,name +" \n \n"+level,phone,Core.IMG_URL+name+".jpg","0","false"));
            }

        }catch (JSONException e){
            e.printStackTrace();
        }
    }
}