package com.app.careerguidance;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.app.Activity;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.BroadcastReceiver;
import android.content.DialogInterface;
import android.graphics.Bitmap;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.TextView;

public class Check_guidiance extends AppCompatActivity {

    WebView webView;
    ProgressDialog pdialog;
    AlertDialog confirmationDialog;
    String curentURL;
    CustomDialogClass cdd;


    private static final String TAG = Check_guidiance.class.getSimpleName();
    private BroadcastReceiver mRegistrationBroadcastReceiver;
    private TextView txtRegId, txtMessage;
    //Drawable pr1ogress;

    WindowManager.LayoutParams lp;

    public Func func;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_check_guidiance);

        func = new Func(Check_guidiance.this);

        webView = (WebView) findViewById(R.id.activity_main_webview);
        //progress = (Drawable) findViewById(R.id.my_progress);
        Drawable progress = getResources().getDrawable(R.drawable.progress);
        WebSettings webSettings = webView.getSettings();
        pdialog = new ProgressDialog(this);
        pdialog.setMessage("Loading...");
        pdialog.setCancelable(false);
        pdialog.setIndeterminate(false);
        pdialog.setIndeterminateDrawable(progress);
        pdialog.show();

        cdd = new CustomDialogClass(Check_guidiance.this);
        lp = new WindowManager.LayoutParams();
        lp.copyFrom(cdd.getWindow().getAttributes());
        lp.width = WindowManager.LayoutParams.MATCH_PARENT;
        lp.height = WindowManager.LayoutParams.MATCH_PARENT;

        webView.loadUrl(Core.SITE_URL+"career.php");

        webView.setWebViewClient(new WebViewClient() {
            @Override
            public void onPageStarted(WebView view, String url,
                                      Bitmap favicon) {
                super.onPageStarted(view, url, favicon);
                if (!pdialog.isShowing()){
                    pdialog.show();
                }
            }

            @Override
            public void onPageFinished(WebView view, String url) {
                super.onPageFinished(view, url);
                if (pdialog.isShowing()) {
                    pdialog.dismiss();
                }
            }

            @Override
            public void onReceivedError(WebView view, int errorCode,
                                        String description, String failingUrl) {
                if (pdialog.isShowing()) {
                    pdialog.dismiss();
                }

                curentURL = failingUrl;
                cdd.setCancelable(false);
                cdd.show();
                cdd.getWindow().setAttributes(lp);
            }

        });

        //webSettings.setJavaScriptEnabled(true);
        webSettings.setJavaScriptCanOpenWindowsAutomatically(false);

        webView.getSettings().setPluginState(WebSettings.PluginState.OFF);
        webView.getSettings().setJavaScriptEnabled(true);
        webView.getSettings().setJavaScriptCanOpenWindowsAutomatically(false);
        webView.getSettings().setSupportMultipleWindows(false);
        webView.getSettings().setSupportZoom(false);
        webView.setVerticalScrollBarEnabled(false);
        webView.setHorizontalScrollBarEnabled(false);

    }

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        if (event.getAction() == KeyEvent.ACTION_DOWN) {
            switch (keyCode) {
                case KeyEvent.KEYCODE_BACK:
                    if (webView.canGoBack()) {
                        webView.goBack();
                    } else {
                        DialogInterface.OnClickListener clickListener = new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {

                                switch (i){
                                    case DialogInterface.BUTTON_POSITIVE :
                                        finish();
                                }

                            }
                        };

                        AlertDialog.Builder builder = new AlertDialog.Builder(this);
                        builder.setMessage("Are you sure, you want to exit Career Guidance?").setPositiveButton("Yes", clickListener)
                                .setNegativeButton("No", clickListener).show();
                    }

                    return true;
            }

        }
        return super.onKeyDown(keyCode, event);
    }

    class CustomDialogClass extends Dialog implements android.view.View.OnClickListener {

        public Activity c;
        public Button refresh;

        public CustomDialogClass(Activity a) {
            super(a);
            // TODO Auto-generated constructor stub
            this.c = a;
        }

        @Override
        protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            requestWindowFeature(Window.FEATURE_NO_TITLE);
            setContentView(R.layout.custom);
            refresh = (Button) findViewById(R.id.refresh_btn);
            refresh.setOnClickListener(this);

        }

        @Override
        public void onClick(View v) {
            switch (v.getId()) {
                case R.id.refresh_btn:
                    webView.loadUrl(curentURL);
                    break;
                default:
                    break;
            }
            dismiss();
        }
    }
}