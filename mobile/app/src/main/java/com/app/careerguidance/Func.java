package com.app.careerguidance;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.graphics.Color;
import android.os.Vibrator;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import androidx.cardview.widget.CardView;



public class Func {

    Activity activity;
    public int flags;

    public ProgressDialog progressDialog;
    Func(Activity myactivity){
        activity = myactivity;
    }

    void startDialog(){
        progressDialog = new ProgressDialog(activity);
        progressDialog.setMessage("Please wait..");
        //progressDialog.setContentView(R.layout.preloader_dialog);
        //LayoutInflater inflater = activity.getLayoutInflater();
        //progressDialog.setContentView(inflater.inflate(R.layout.preloader_dialog, null));
        //progressDialog.getWindow().setBackgroundDrawableResource(android.R.color.transparent);
        progressDialog.setCancelable(false);
        progressDialog.setIndeterminate(false);

        progressDialog.show();
    }

    void dismissDialog(){
        progressDialog.hide();
    }

    

    void full_screen(){
        flags = View.SYSTEM_UI_FLAG_LAYOUT_STABLE | View.SYSTEM_UI_FLAG_LAYOUT_HIDE_NAVIGATION |
                View.SYSTEM_UI_FLAG_LAYOUT_FULLSCREEN | View.SYSTEM_UI_FLAG_HIDE_NAVIGATION |
                View.SYSTEM_UI_FLAG_FULLSCREEN | View.SYSTEM_UI_FLAG_IMMERSIVE_STICKY;

        activity.getWindow().getDecorView().setSystemUiVisibility(flags);
        final View decorView = activity.getWindow().getDecorView();
        decorView.setOnSystemUiVisibilityChangeListener(new View.OnSystemUiVisibilityChangeListener() {
            @Override
            public void onSystemUiVisibilityChange(int visibility) {
                if ((visibility & View.SYSTEM_UI_FLAG_FULLSCREEN) == 0) {
                    decorView.setSystemUiVisibility(flags);
                }
            }
        });
    }
}
