package com.app.careerguidance;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.makeramen.roundedimageview.RoundedTransformationBuilder;
import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;

import java.util.List;

public class RecyclerViewAdaptersDevelopers extends RecyclerView.Adapter<RecyclerViewAdaptersDevelopers.MyViewHolder>{

    Context mContext;
    private List<List_students> mData;

    public RecyclerViewAdaptersDevelopers(Context mContext, List<List_students> mData) {
        this.mContext = mContext;
        this.mData = mData;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View view;
        view = LayoutInflater.from(parent.getContext()).inflate(R.layout.lists_students, parent,false);
        MyViewHolder viewHolder = new MyViewHolder(view);

        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, final int position) {
        holder.st_matric.setText(((List_students) mData.get(position)).getMatric());
        holder.st_name.setText(((List_students) mData.get(position)).getName());
        holder.st_level.setText(((List_students) mData.get(position)).getLevel());

        Transformation transformation = new RoundedTransformationBuilder()
                .cornerRadiusDp(50)
                .oval(true)
                .build();

        Picasso.get().load(mData.get(position).getImage()).transform(transformation).into(holder.st_image);


    }

    @Override
    public int getItemCount() {
        return mData.size();
    }

    public RecyclerViewAdaptersDevelopers (List<List_students> mData){
        this.mData = mData;
    }

    public static class MyViewHolder extends RecyclerView.ViewHolder{

        private TextView st_level;
        private ImageView st_image;
        private TextView st_matric;
        private TextView st_name;

        public MyViewHolder(@NonNull View itemView) {

            super(itemView);

            st_matric = (TextView) itemView.findViewById(R.id.st_matric);
            st_name = (TextView) itemView.findViewById(R.id.st_name);
            st_level = (TextView) itemView.findViewById(R.id.st_level);
            st_image = (ImageView) itemView.findViewById(R.id.st_image);

        }
    }

}
